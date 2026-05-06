<?php
/**
 * Test Runner for CSSValidator (Standalone)
 * 
 * Run this script from the terminal:
 * php tests/CSSValidatorTest.php
 */

namespace CMLS_Base\Tests;

// Mock ABSPATH for standalone testing
if (!defined('ABSPATH')) {
    define('ABSPATH', true);
}

require_once __DIR__ . '/../functions/css-validator.php';
use CMLS_Base\CSSValidator;

class CSSValidatorTest {
    private int $pass_count = 0;
    private int $fail_count = 0;
    private array $failures = [];

    public function run(): void {
        echo "\e[1;34mStarting CSSValidator Comprehensive Tests\e[0m\n";
        echo str_repeat('=', 50) . "\n\n";

        $this->testColors();
        $this->testLengths();
        $this->testBoxModel();
        $this->testBorders();
        $this->testBackgrounds();
        $this->testFlexbox();
        $this->testSecurity();
        $this->testMultiValues();
        $this->testEdgeCases();

        echo "\n" . str_repeat('=', 50) . "\n";
        if ($this->fail_count === 0) {
            echo "\e[1;32mALL TESTS PASSED (" . $this->pass_count . " total)\e[0m\n";
            exit(0);
        } else {
            echo "\e[1;31mTESTS FAILED (" . $this->fail_count . " failures, " . $this->pass_count . " passes)\e[0m\n";
            foreach ($this->failures as $fail) {
                echo " - $fail\n";
            }
            exit(1);
        }
    }

    private function assert(string $method, string $value, bool $expected, string $label): void {
        $result = CSSValidator::$method($value);
        if ($result === $expected) {
            $this->pass_count++;
            echo "\e[32m✔\e[0m $label\n";
        } else {
            $this->fail_count++;
            $error = sprintf(
                "[%s] '%s' expected %s, got %s",
                $method,
                $value,
                $expected ? 'true' : 'false',
                $result ? 'true' : 'false'
            );
            $this->failures[] = "$label: $error";
            echo "\e[31m✘ $label\e[0m\n";
            echo "   \e[90m$error\e[0m\n";
        }
    }

    private function testColors(): void {
        echo "\e[1;33m[Colors]\e[0m\n";
        // Valid
        $this->assert('validateColor', '#fff', true, 'Hex 3-digit');
        $this->assert('validateColor', '#ffffff', true, 'Hex 6-digit');
        $this->assert('validateColor', '#ffff', true, 'Hex 4-digit (Alpha)');
        $this->assert('validateColor', '#ffffffff', true, 'Hex 8-digit (Alpha)');
        $this->assert('validateColor', 'red', true, 'Named color');
        $this->assert('validateColor', 'transparent', true, 'Transparent');
        $this->assert('validateColor', 'rgb(0,0,0)', true, 'RGB 3-args');
        $this->assert('validateColor', 'rgba(0,0,0)', true, 'RGBA 3-args (Modern Alias)');
        $this->assert('validateColor', 'rgba(0,0,0,0.5)', true, 'RGBA 4-args');
        
        // Invalid Typos
        $this->assert('validateColor', '#ff', false, 'Hex too short');
        $this->assert('validateColor', '#fffff', false, 'Hex 5-digit');
        $this->assert('validateColor', '#fffffff', false, 'Hex 7-digit');
        $this->assert('validateColor', '#ffg', false, 'Invalid hex character');
        $this->assert('validateColor', 'rgb(0,0)', false, 'RGB too few arguments');
        $this->assert('validateColor', 'hsl(0,0,0)', false, 'HSL missing units');
    }

    private function testLengths(): void {
        echo "\n\e[1;33m[Lengths & Units]\e[0m\n";
        $this->assert('validateLength', '10px', true, 'Pixels');
        $this->assert('validateLength', '2rem', true, 'Rem');
        $this->assert('validateLength', '0', true, 'Zero unitless');
        $this->assert('validateLength', '50%', true, 'Percentage (where allowed)');
        $this->assert('validateLength', '10abc', false, 'Invalid unit');
        $this->assert('validateLength', '10.5.5px', false, 'Malformed number');
    }

    private function testBoxModel(): void {
        echo "\n\e[1;33m[Box Model]\e[0m\n";
        $this->assert('validateMargin', '10px 20px 30px 40px', true, 'Margin 4 values');
        $this->assert('validateMargin', '10px 20px 30px 40px 50px', false, 'Margin 5 values');
        $this->assert('validatePadding', '10%', true, 'Padding percentage');
    }

    private function testBorders(): void {
        echo "\n\e[1;33m[Borders]\e[0m\n";
        $this->assert('validateBorder', '1px solid red', true, 'Border standard');
        $this->assert('validateBorder', '10% solid red', false, 'Border with percentage (Invalid)');
    }

    private function testBackgrounds(): void {
        echo "\n\e[1;33m[Backgrounds]\e[0m\n";
        $this->assert('validateImage', 'none', true, 'Background none');
        $this->assert('validateImage', 'url("test.png")', true, 'URL double quotes');
        $this->assert('validateImage', "url('test.png')", true, 'URL single quotes');
        $this->assert('validateImage', 'linear-gradient(to bottom, #fff, #000)', true, 'Linear gradient');
    }

    private function testFlexbox(): void {
        echo "\n\e[1;33m[Flexbox]\e[0m\n";
        $this->assert('validateFlexAlignment', 'center', true, 'Justify center');
        $this->assert('validateFlexAlignment', 'space-between', true, 'Justify space-between');
    }

    private function testSecurity(): void {
        echo "\n\e[1;33m[Security & Injection]\e[0m\n";
        // Injection attempts
        $this->assert('validateColor', 'rgb(0,0,0); injection', false, 'Semicolon outside');
        $this->assert('validateColor', 'rgb(0;0;0)', false, 'Semicolon inside function');
        $this->assert('validateColor', 'red { background: url(evil) }', false, 'Braces injection');
        $this->assert('validateColor', 'red; background: url(javascript:alert(1))', false, 'JS protocol injection');
        $this->assert('validateColor', 'expression(alert(1))', false, 'IE expression injection');
        $this->assert('validateColor', 'url("javascript:alert(1)")', false, 'URL JS injection');
        $this->assert('validateColor', '-moz-binding: url(http://evil)', false, 'XBL binding injection');
        
        // Obfuscation attempts
        $this->assert('validateColor', '\0072\0065\0064', false, 'CSS escape sequence');
        $this->assert('validateColor', '/* comment */ red', false, 'Comment obfuscation');
    }

    private function testMultiValues(): void {
        echo "\n\e[1;33m[Multi-value Lists]\e[0m\n";
        $this->assert('validateImage', 'url(a.png), url(b.png)', true, 'Multiple background images');
        $this->assert('validateColor', 'red, blue', false, 'Multiple colors (not allowed for color)');
    }

    private function testEdgeCases(): void {
        echo "\n\e[1;33m[Edge Cases]\e[0m\n";
        $this->assert('validateColor', '', false, 'Empty string');
        $this->assert('validateColor', '   ', false, 'Whitespace only');
        $this->assert('validateColor', 'rgb(0,0,0', false, 'Mismatched parenthesis');
        $this->assert('validateLength', 'calc(100% - (2 * 5px))', true, 'Nested calc parens');
        $this->assert('validateColor', '#ffffff #000000', false, 'Multiple colors without comma');
    }
}

$tester = new CSSValidatorTest();
$tester->run();
