# White – WordPress Theme

## 📌 About
**White** is a WordPress theme designed for optimized performance, using **Vite** for a fast build process and **Sass** for styling. The theme is built primarily as a **Classic Theme** but with a forward-looking approach, incorporating initial support for **Gutenberg blocks** in future updates. **Advanced Custom Fields (ACF)** is utilized to provide greater flexibility in content customization.

## 🛠️ Requirements
Ensure your environment meets the following requirements:
- **WordPress** 6.0 or higher
- **PHP** 8.1 or higher
- **Node.js** 18+
- **Composer** (for managing WordPress dependencies, if needed)

## 📂 Installation
1. Clone or copy this repository into the WordPress themes folder:
   ```sh
   wp-content/themes/
   ```
2. Navigate to the theme directory and install dependencies:
   ```sh
   npm install
   ```
3. Ensure you have a `.env` file in the root of the theme and add the following variables:
    ```sh
    VERSION=1.0.0
    THEME_NAME=white
    ```
4. For development purposes, you can create `.env.development` to keep certain configurations environment-specific.

5. To compile files and start the watch mode, run:
   ```sh
   npm run watch
   ```
6. To generate optimized production files, run:
   ```sh
   npm run build
   ```
7. Activate the theme in the WordPress dashboard.

## 📜 Project Structure (WIP)
```
/white  
  ├── assets/                # Static assets (CSS, JS, images)  
  ├── dist/                  # Compiled output files  
  ├── inc/                   # Core includes  
  │   ├── acf-json/          # ACF configurations  
  │   ├── plugins/           # Custom plugins (ACF, ACF Extends, ACF Font Awesome)  
  │   ├── tools/             # Utility scripts  
  │   ├── enqueue.php        # Scripts and styles management  
  │   ├── helpers.php        # Helper functions  
  │   ├── include.php        # General includes  
  │   ├── theme-setup.php    # Theme setup and initialization  
  ├── sections/              # Custom theme sections  
  │   ├── section-.php  
  ├── templates/             # Theme template files  
  │   ├── default.php  
  ├── .env                   # Environment variables  
  ├── footer.php             # Footer template  
  ├── functions.php          # WordPress theme functions  
  ├── header.php             # Header template  
  ├── index.php              # Main theme file  
  ├── package.json           # NPM dependencies  
  ├── style.css              # WordPress theme stylesheet  
  ├── vite.config.js         # Vite configuration file  

```

## 📦 Package.json Scripts and Usage
The `package.json` file includes the following scripts to streamline the development and build processes:

### 🔧 Development and Build Scripts
| Script | Command | Description |
|--------|---------|-------------|
| `watch` | `npm run watch` | Runs Vite in watch mode for live updates. |
| `watch:assets` | `npm run watch:assets` | Watches and rebuilds asset files when changed. |
| `watch:sections` | `npm run watch:sections` | Watches and rebuilds section-specific files. |
| `build` | `npm run build` | Builds all assets and sections for production. |
| `build:assets` | `npm run build:assets` | Compiles only assets. |
| `build:sections` | `npm run build:sections` | Compiles only sections. |

### 🚀 Deployment Scripts
| Script | Command | Description |
|--------|---------|-------------|
| `update-version` | `npm run update-version` | Updates the theme version in relevant files. |
| `compile` | `npm run compile` | Updates version, builds assets, and generates a zip for deployment. |

### 📜 Dependencies
- **Development Dependencies**:
  - `vite`: Build tool for optimized performance.
  - `npm-run-all`: Runs multiple scripts in parallel or sequentially.
  - `husky`: Enforces Git hooks for better commit practices.
  - `cross-env`: Ensures cross-platform compatibility for environment variables.
  - `fast-glob`: Handles file patterns efficiently.
  - `@commitlint/cli` & `@commitlint/config-conventional`: Enforces commit message guidelines.

- **Production Dependencies**:
  - `archiver`: Used for generating zip files during deployment.
  - `dotenv`: Manages environment variables.
  - `glightbox`: A lightweight JavaScript library for image and video lightboxes.
  - `imask`: Provides input masking functionality.
  - `sass`: Compiles SCSS stylesheets.

## 🔄 Development
- The theme uses **Vite** for build, enabling a fast development workflow.
- **ACF** configurations are stored in the `acf-json/` folder for versioning and synchronization.
- The theme follows a **Classic Theme** structure with a modular approach, allowing easy integration of **Gutenberg blocks** in the future.
- Modular and scalable code ensures maintainability and expansion.



# Commit Guidelines

This provides a standardized format for writing commit messages to maintain a clean and structured Git history.

---

## **Commit Format**

All commit messages must follow the format:

```
[TAG] : Commit message
```

Where `[TAG]` represents the type of commit and the commit message provides a clear description of the change.

---

## **Allowed Commit Types & Tags**

| Type          | Tag          | Description                                      |
| ------------- | ------------ | ------------------------------------------------ |
| Feature       | `[FEATURE]`  | Adding a new feature                             |
| Fix           | `[FIX]`      | Bug fixes                                        |
| Documentation | `[DOCS]`     | Updates to documentation                         |
| Style         | `[STYLE]`    | Code formatting changes (no logic change)        |
| Refactor      | `[REFACTOR]` | Code improvements without changing functionality |
| Test          | `[TEST]`     | Adding or modifying tests                        |
| Chore         | `[CHORE]`    | Maintenance tasks like dependency updates        |
| Build         | `[BUILD]`    | Changes related to build tools or dependencies   |
| CI/CD         | `[CI]`       | Changes to CI/CD configuration                   |
| Performance   | `[PERF]`     | Performance improvements                         |
| Revert        | `[REVERT]`   | Reverting a previous commit                      |
| Hotfix        | `[HOTFIX]`   | Urgent fixes for critical issues                 |

---

## **Example Commit Messages**

```sh
git commit -m "feat: is used when adding a new functionality to the project."
git commit -m "fix: is used to indicate a bug fix in the application."
git commit -m "docs: is used for updates in documentation without changing the code."
git commit -m "style: is used for code formatting changes without affecting functionality."
git commit -m "refactor: is used when restructuring code without changing its behavior."
git commit -m "test: is used when adding or modifying tests."
git commit -m "chore: is used for maintenance tasks like dependency updates."
git commit -m "build: is used when modifying the build system or dependencies."
git commit -m "ci: is used when making changes to CI/CD configuration."
git commit -m "perf: is used when enhancing performance without changing features."
git commit -m "revert: is used when reverting a previous commit."
git commit -m "hotfix: is used for urgent fixes to critical issues in production."

```

---

By following these guidelines, we ensure a structured and meaningful Git history that helps in better collaboration and traceability of changes.
