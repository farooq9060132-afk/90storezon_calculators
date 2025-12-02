# Contributing to 90storezon Calculators

Thank you for your interest in contributing to the 90storezon Calculators project! This document outlines the process for contributing to our collection of online calculators.

## Code of Conduct

By participating in this project, you are expected to uphold our Code of Conduct (to be added).

## How Can I Contribute?

### Reporting Bugs

If you find a bug in any of our calculators:
1. Check if the issue already exists in our issue tracker
2. If not, create a new issue with:
   - A clear title and description
   - Steps to reproduce the bug
   - Expected vs. actual behavior
   - Screenshots if applicable
   - Browser and device information

### Suggesting Enhancements

We welcome suggestions for new features or improvements:
1. Check if the enhancement is already requested
2. If not, create a new issue with:
   - A clear description of the enhancement
   - Use cases and benefits
   - Mockups or examples if applicable

### Adding New Calculators

To add a new calculator:
1. Fork the repository
2. Create a new folder in the `calculators/` directory with the naming convention `NN-calculator-name` (where NN is the next available number)
3. Implement the calculator using our single-file approach (index.php)
4. Ensure responsive design and consistent styling
5. Test thoroughly across different devices
6. Submit a pull request with a description of your calculator

### Improving Existing Calculators

To improve existing calculators:
1. Fork the repository
2. Make your changes to the specific calculator folder
3. Ensure backward compatibility
4. Test thoroughly
5. Submit a pull request

## Development Guidelines

### PHP Standards
- Follow PSR-12 coding standards
- Use meaningful variable and function names
- Comment complex logic
- Keep functions focused and small

### JavaScript Standards
- Use modern ES6+ syntax where appropriate
- Comment complex algorithms
- Ensure cross-browser compatibility

### CSS Standards
- Use consistent class naming (BEM methodology)
- Mobile-first responsive design
- Reuse existing styles where possible

### File Structure
- Each calculator should be implemented in a single index.php file
- Keep folder names consistent with the numbering system
- Maintain clean URLs through .htaccess rules

## Pull Request Process

1. Ensure your code follows our development guidelines
2. Update the README.md if you're adding new features
3. Add yourself to the contributors list (if desired)
4. Submit a pull request with a clear title and description
5. Wait for review and address any feedback

## Questions?

If you have any questions about contributing, feel free to open an issue or contact the maintainers.