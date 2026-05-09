#!/bin/bash
#
# Blackbox Test: Admin Panel Primary Button Color
# ===============================================
# Verifies that the Filament admin panel uses #080C0E as the primary color.
# This script curls the live admin login page and inspects the rendered
# CSS/HTML to confirm the color is applied to buttons.
#

set -euo pipefail

# ── Configuration ──────────────────────────────────────────────
BASE_URL="${BASE_URL:-http://localhost:8000}"
ADMIN_PATH="/admin/login"
EXPECTED_COLOR="#080C0E"
EXPECTED_COLOR_HEX="080C0E"
TIMEOUT=10
PASS=0
FAIL=0

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

# ── Helpers ────────────────────────────────────────────────────
log_info()  { echo -e "${CYAN}[INFO]${NC}  $*"; }
log_pass()  { echo -e "${GREEN}[PASS]${NC}  $*"; PASS=$((PASS + 1)); }
log_fail()  { echo -e "${RED}[FAIL]${NC}  $*"; FAIL=$((FAIL + 1)); }
log_warn()  { echo -e "${YELLOW}[WARN]${NC}  $*"; }

banner() {
    echo ""
    echo "════════════════════════════════════════════════════════════"
    echo "  Blackbox Test: Admin Primary Button Color"
    echo "  Expected Primary: ${EXPECTED_COLOR}"
    echo "  Target: ${BASE_URL}${ADMIN_PATH}"
    echo "════════════════════════════════════════════════════════════"
    echo ""
}

# ── Test 1: Server Reachable ───────────────────────────────────
test_server_reachable() {
    log_info "Test 1: Checking if server is reachable at ${BASE_URL}..."

    HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" --max-time "${TIMEOUT}" "${BASE_URL}${ADMIN_PATH}" 2>/dev/null || echo "000")

    if [[ "${HTTP_CODE}" == "200" ]]; then
        log_pass "Server responded with HTTP 200"
    elif [[ "${HTTP_CODE}" == "000" ]]; then
        log_fail "Server is NOT reachable at ${BASE_URL} — is 'php artisan serve' running?"
        log_info "Start the server with: php artisan serve"
        return 1
    else
        log_warn "Server responded with HTTP ${HTTP_CODE} (not 200), proceeding anyway..."
    fi
}

# ── Test 2: Page Contains Filament Assets ──────────────────────
test_page_loads_filament() {
    log_info "Test 2: Fetching admin login page..."

    HTML=$(curl -s --max-time "${TIMEOUT}" "${BASE_URL}${ADMIN_PATH}" 2>/dev/null || echo "")

    if [[ -z "${HTML}" ]]; then
        log_fail "Empty response from server"
        return 1
    fi

    if echo "${HTML}" | grep -qi "filament"; then
        log_pass "Page contains Filament references"
    else
        log_warn "Page does NOT contain 'filament' string — might be redirected or not Filament-enabled"
    fi

    # Save HTML for later inspection
    echo "${HTML}" > /tmp/admin_login_page.html
}

# ── Test 3: Primary Color in Inline Styles / CSS ───────────────
test_primary_color_in_css() {
    log_info "Test 3: Searching for expected primary color ${EXPECTED_COLOR} in page source..."

    HTML=$(cat /tmp/admin_login_page.html)

    # Filament renders its color palette as CSS custom properties, e.g.:
    #   --primary-500: 8 12 14;
    # Or inline hex in style tags / tailwind classes
    # We search for the hex in various formats

    FOUND=false

    # Check literal hex
    if echo "${HTML}" | grep -qi "${EXPECTED_COLOR_HEX}"; then
        FOUND=true
    fi

    # Check CSS variable format (Filament uses oklch space-separated values)
    if echo "${HTML}" | grep -qE -- "--primary-[0-9]+:\s*8\s+12\s+14"; then
        FOUND=true
    fi

    # Check for bg-primary-600 or similar Tailwind classes with inline styles
    if echo "${HTML}" | grep -q "background.*${EXPECTED_COLOR_HEX}"; then
        FOUND=true
    fi

    if ${FOUND}; then
        log_pass "Primary color ${EXPECTED_COLOR} found in page source"
    else
        log_fail "Primary color ${EXPECTED_COLOR} NOT found in page source"
        log_info "Dumping relevant snippets for debugging..."
        echo ""
        echo "── CSS custom properties (--primary-*): ──"
        echo "${HTML}" | grep -oE -- '--primary-[^;]*;' 2>/dev/null | head -10 || echo "(none found)"
        echo ""
        echo "── Hex colors in source: ──"
        echo "${HTML}" | grep -oE '#[0-9a-fA-F]{6}' 2>/dev/null | sort -u | head -20 || echo "(none found)"
        echo ""
    fi
}

# ── Test 4: Button Classes Reference Primary ───────────────────
test_button_uses_primary() {
    log_info "Test 4: Checking if login button references primary color..."

    HTML=$(cat /tmp/admin_login_page.html)

    # Filament's submit/login button typically uses classes like:
    #   bg-primary-600 hover:bg-primary-500
    # or inline style with the primary color

    BUTTON_FOUND=false

    if echo "${HTML}" | grep -qE 'button[^>]*(primary|submit|login)'; then
        BUTTON_FOUND=true
    fi

    if echo "${HTML}" | grep -qE 'bg-primary-[0-9]+'; then
        log_pass "Button uses Tailwind 'bg-primary-*' utility class"
    elif echo "${HTML}" | grep -qE "background-color[^;]*${EXPECTED_COLOR_HEX}"; then
        log_pass "Button uses inline background-color: ${EXPECTED_COLOR}"
    elif ${BUTTON_FOUND}; then
        log_warn "Button found but could not verify primary color binding"
    else
        log_fail "No login button with primary color found"
    fi
}

# ── Test 5: Filament Panel Config (Code-Level Check) ───────────
test_panel_config() {
    log_info "Test 5: Checking AdminPanelProvider source for primary color..."

    PROVIDER_FILE="app/Providers/Filament/AdminPanelProvider.php"

    if [[ ! -f "${PROVIDER_FILE}" ]]; then
        log_fail "AdminPanelProvider file not found at ${PROVIDER_FILE}"
        return 1
    fi

    if grep -q "\"primary\".*\"${EXPECTED_COLOR}\"" "${PROVIDER_FILE}"; then
        log_pass "AdminPanelProvider sets \"primary\" => \"${EXPECTED_COLOR}\""
    elif grep -q "'primary'.*'${EXPECTED_COLOR}'" "${PROVIDER_FILE}"; then
        log_pass "AdminPanelProvider sets 'primary' => '${EXPECTED_COLOR}'"
    else
        log_fail "AdminPanelProvider does NOT have \"primary\" => \"${EXPECTED_COLOR}\""
        log_info "Current primary color line:"
        grep -n "primary" "${PROVIDER_FILE}" || echo "(no 'primary' key found)"
    fi
}

# ── Main ───────────────────────────────────────────────────────
main() {
    banner

    test_server_reachable || {
        log_info "Skipping server-dependent tests. Running code-level test only..."
        echo ""
        test_panel_config
        summary
        exit 1
    }

    echo ""
    test_page_loads_filament
    echo ""
    test_primary_color_in_css
    echo ""
    test_button_uses_primary
    echo ""
    test_panel_config
    echo ""

    summary
}

summary() {
    TOTAL=$((PASS + FAIL))
    echo "════════════════════════════════════════════════════════════"
    echo "  Results: ${PASS} passed, ${FAIL} failed (${TOTAL} total)"
    echo "════════════════════════════════════════════════════════════"

    if [[ ${FAIL} -eq 0 ]]; then
        echo -e "\n${GREEN}✓ ALL CHECKS PASSED — Primary color ${EXPECTED_COLOR} is active.${NC}\n"
        exit 0
    else
        echo -e "\n${RED}✗ ${FAIL} CHECK(S) FAILED — Primary color may not be ${EXPECTED_COLOR}.${NC}\n"
        exit 1
    fi
}

# ── Run ────────────────────────────────────────────────────────
main "$@"
