# AGENTS.md - Developer and Automation Guide for `tec-chat-live`

This document provides guidelines and processes for agents that work with this codebase. The repository houses a WordPress plugin named "Chat Widget" with custom HTML, CSS, JavaScript, and PHP components.

## Build, Lint, and Test Commands
Currently, the repository lacks a formal build, lint, and test setup. Below are useful commands and manual processes that agents can follow:

### Plugin Installation and Activation
1. Zip the plugin folder: `zip -r tec-chat-live.zip tec-chat-live`
2. Install the plugin in WordPress:
   - Navigate to `Plugins` > `Add New` > `Upload Plugin` in the WordPress dashboard.
   - Upload the `.zip` file and activate the plugin.

### Asset Management
- **CSS & JS Files**: Ensure that changes to `assets/style.css` and `assets/scripts.js` are reflected by force refreshing browsers (e.g., `Ctrl + F5`).
- **Versioning Tip**: To prevent caching issues, append query parameters with timestamps in `wp_enqueue` calls:
  ```php
  wp_enqueue_script('chat-widget-custom-script', plugin_dir_url(__FILE__) . 'assets/scripts.js?v=' . time(), array(), null, true);
  ```

### Manual Testing
- Test the plugin manually in a WordPress site to verify changes.
- Focus testing on the following:
  - Floating Button Appearance
  - Chat Window Functionality (Expand/Collapse)
  - Message Submission

### Debugging PHP
WordPress often suppresses PHP errors in production. To debug effectively:
1. Enable debugging in `wp-config.php`:
   ```php
   define('WP_DEBUG', true);
   define('WP_DEBUG_LOG', true);
   ```
2. Review logs in `/wp-content/debug.log`.

---

## Code Style Guidelines
This repository does not have automated linting or formatting. Follow these conventions:

### 1. PHP Code
- **Syntax**: Follow [PSR-12](https://www.php-fig.org/psr/psr-12/).
- **Error Handling**:
  - Wrap critical code with `try-catch` or use conditionals for error states.
- **Functions**:
  - Prefix functions with `chat_widget_` to avoid namespace collisions.
  - Example:
    ```php
    function chat_widget_render() {
        // Code here
    }
    ```
- **Hooks**:
  - Use appropriate action/filter hooks. Example: `add_action('wp_enqueue_scripts', 'chat_widget_custom_assets');`

### 2. JavaScript Code
- **Formatting**: Follow [Airbnb JavaScript Style Guide](https://github.com/airbnb/javascript).
- **Imports**:
  - Keep imports and external assets within `assets/` only.
- **Error Handling**:
  - Use `try-catch` blocks in asynchronous operations.
  - Example:
    ```javascript
    try {
        const button = document.getElementById('toggleChatBtn');
        button.addEventListener('click', toggleChat);
    } catch (error) {
        console.error('Failed to initialize chat widget:', error);
    }
    ```

### 3. CSS
- **Style Guide**:
  - Use class-based naming in `BEM` style. E.g., `chat-widget__button` for elements.
  - Group common styles together, such as sizing, layout, and colors.
- **Responsiveness**:
  - Ensure mobile and desktop views are adequately styled.

---

## Repository Conventions

### Naming Conventions
- **File Names**:
  - Use lowercase letters with hyphens: `tec-chat-live/`.
  - Place assets in the `/assets/` directory.
- **Functions/Variables**:
  - PHP: `snake_case`
  - JavaScript: `camelCase`

### File Organization
- **PHP**:
  - All PHP code resides in the root file `tec-chat-live.php`.
- **CSS/JavaScript**:
  - Keep all styles and scripts scoped within the `assets/` folder.

---

# Improvements
To upgrade this repository for better agent automation:

1. **Testing Framework**:
   - Add a testing framework for PHP, such as PHPUnit.
   - Example: Structure tests under a `/tests/` folder.

2. **Linting**:
   - Use linters for JavaScript (`ESLint`) and CSS (`Stylelint`).
   - Automate linting with a `package.json` script.

3. **CI/CD**:
   - Create GitHub Actions for automated testing and deployment.

For questions or assistance, consult project owner [dvasquez](https://technoloqie.site/).