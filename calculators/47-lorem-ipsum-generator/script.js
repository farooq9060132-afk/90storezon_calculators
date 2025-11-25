class LoremIpsumGenerator {
    constructor() {
        this.loremData = {
            standard: [
                "lorem", "ipsum", "dolor", "sit", "amet", "consectetur", "adipiscing", "elit", 
                "sed", "do", "eiusmod", "tempor", "incididunt", "ut", "labore", "et", "dolore", 
                "magna", "aliqua", "enim", "ad", "minim", "veniam", "quis", "nostrud", 
                "exercitation", "ullamco", "laboris", "nisi", "aliquip", "ex", "ea", "commodo", 
                "consequat", "duis", "aute", "irure", "in", "reprehenderit", "voluptate", 
                "velit", "esse", "cillum", "eu", "fugiat", "nulla", "pariatur", "excepteur", 
                "sint", "occaecat", "cupidatat", "non", "proident", "sunt", "culpa", "qui", 
                "officia", "deserunt", "mollit", "anim", "id", "est", "laborum"
            ],
            classic: [
                "sed", "ut", "perspiciatis", "unde", "omnis", "iste", "natus", "error", 
                "sit", "voluptatem", "accusantium", "doloremque", "laudantium", "totam", 
                "rem", "aperiam", "eaque", "ipsa", "quae", "ab", "illo", "inventore", 
                "veritatis", "et", "quasi", "architecto", "beatae", "vitae", "dicta", 
                "sunt", "explicabo", "nemo", "enim", "ipsam", "voluptatem", "quia", 
                "voluptas", "sit", "aspernatur", "aut", "odit", "aut", "fugit", "sed", 
                "quia", "consequuntur", "magni", "dolores", "eos", "qui", "ratione", 
                "voluptatem", "sequi", "nesciunt"
            ],
            modern: [
                "leverage", "agile", "frameworks", "provide", "robust", "synopsis", 
                "high", "level", "overview", "iterative", "approaches", "corporate", 
                "strategy", "foster", "collaborative", "thinking", "further", "overall", 
                "value", "proposition", "organically", "grow", "holistic", "world", 
                "view", "disruptive", "innovation", "workplace", "diversity", "empowerment"
            ],
            tech: [
                "binary", "algorithm", "framework", "interface", "database", "cloud", 
                "encryption", "firewall", "bandwidth", "cache", "compiler", "debug", 
                "encapsulation", "gigabyte", "javascript", "kernel", "latency", "metadata", 
                "nanosecond", "open-source", "protocol", "query", "responsive", "scalable", 
                "template", "user-interface", "virtual", "wireless", "xml", "yottabyte", "zip"
            ],
            hipster: [
                "artisan", "craft", "bespoke", "sustainable", "organic", "locavore", 
                "vinyl", "retro", "aesthetic", "minimal", "vintage", "authentic", 
                "slow-carb", "meggings", "vegan", "paleo", "gluten-free", "chia", 
                "selvage", "pinterest", "hashtag", "tote-bag", "cold-pressed", "farm-to-table", 
                "intelligentsia", "humblebrag", "wolf", "moon", "portland", "brooklyn"
            ],
            cupcake: [
                "cupcake", "dessert", "sweet", "sugar", "chocolate", "vanilla", 
                "caramel", "frosting", "sprinkles", "pastry", "baking", "buttercream", 
                "confection", "delight", "treat", "yummy", "delicious", "scrumptious", 
                "mouthwatering", "delectable", "irresistible", "heavenly", "divine", 
                "ambrosial", "luscious", "palatable", "savory", "flavorful", "tasty", "yum"
            ]
        };

        this.initializeEventListeners();
    }

    initializeEventListeners() {
        document.getElementById('generateLorem').addEventListener('click', () => this.generateLoremIpsum());
        document.getElementById('copyText').addEventListener('click', () => this.copyText());
        document.getElementById('clearAll').addEventListener('click', () => this.clearAll());
        
        // Add event listeners to template items
        document.querySelectorAll('.template-item').forEach(item => {
            item.addEventListener('click', () => this.loadTemplate(item));
        });

        // Enter key to generate
        document.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' && e.ctrlKey) {
                e.preventDefault();
                this.generateLoremIpsum();
            }
        });
    }

    generateLoremIpsum() {
        const textType = document.getElementById('textType').value;
        const quantity = parseInt(document.getElementById('quantity').value);
        const variant = document.getElementById('loremVariant').value;
        const startWithLorem = document.getElementById('startWithLorem').value === 'yes';
        const includeLinks = document.getElementById('includeLinks').checked;
        const includeFormatting = document.getElementById('includeFormatting').checked;
        const includeLists = document.getElementById('includeLists').checked;
        const autoCopy = document.getElementById('autoCopy').checked;

        if (quantity < 1 || quantity > 100) {
            this.showError('Please enter a quantity between 1 and 100.');
            return;
        }

        try {
            let generatedText = '';

            switch (textType) {
                case 'paragraphs':
                    generatedText = this.generateParagraphs(quantity, variant, startWithLorem, includeLinks, includeFormatting);
                    break;
                case 'words':
                    generatedText = this.generateWords(quantity, variant, startWithLorem);
                    break;
                case 'sentences':
                    generatedText = this.generateSentences(quantity, variant, startWithLorem);
                    break;
                case 'list':
                    generatedText = this.generateList(quantity, variant, startWithLorem, includeFormatting);
                    break;
            }

            // Add lists if requested
            if (includeLists && textType !== 'list') {
                generatedText += this.addRandomLists(variant);
            }

            // Update output
            this.updateOutput(generatedText, textType, quantity);
            this.hideError();

            // Auto-copy if enabled
            if (autoCopy) {
                setTimeout(() => this.copyText(), 500);
            }

        } catch (error) {
            this.showError(`Generation failed: ${error.message}`);
        }
    }

    generateParagraphs(count, variant, startWithLorem, includeLinks, includeFormatting) {
        let paragraphs = [];
        
        for (let i = 0; i < count; i++) {
            let paragraph = '';
            const sentenceCount = this.getRandomInt(3, 8);
            
            for (let j = 0; j < sentenceCount; j++) {
                if (i === 0 && j === 0 && startWithLorem) {
                    paragraph += this.capitalize(this.getLoremStart(variant)) + ' ';
                } else {
                    paragraph += this.generateSentence(variant, j === 0) + ' ';
                }
            }
            
            // Add formatting if requested
            if (includeFormatting && Math.random() > 0.7) {
                paragraph = this.addFormatting(paragraph);
            }
            
            // Add links if requested
            if (includeLinks && Math.random() > 0.8) {
                paragraph = this.addLinks(paragraph, variant);
            }
            
            paragraphs.push(paragraph.trim());
        }
        
        return paragraphs.join('\n\n');
    }

    generateWords(count, variant, startWithLorem) {
        const words = this.loremData[variant];
        let result = [];
        
        if (startWithLorem) {
            result.push('Lorem');
            result.push('ipsum');
            result.push('dolor');
            result.push('sit');
            result.push('amet');
            count -= 5;
        }
        
        for (let i = 0; i < count; i++) {
            const randomWord = words[Math.floor(Math.random() * words.length)];
            if (i === 0 && result.length === 0) {
                result.push(this.capitalize(randomWord));
            } else {
                result.push(randomWord);
            }
        }
        
        return result.join(' ');
    }

    generateSentences(count, variant, startWithLorem) {
        let sentences = [];
        
        for (let i = 0; i < count; i++) {
            if (i === 0 && startWithLorem) {
                sentences.push(this.capitalize(this.getLoremStart(variant)));
            } else {
                sentences.push(this.generateSentence(variant, true));
            }
        }
        
        return sentences.join(' ');
    }

    generateList(count, variant, startWithLorem, includeFormatting) {
        let listItems = [];
        
        for (let i = 0; i < count; i++) {
            let item = '';
            const wordCount = this.getRandomInt(3, 8);
            const words = this.loremData[variant];
            
            for (let j = 0; j < wordCount; j++) {
                const randomWord = words[Math.floor(Math.random() * words.length)];
                if (j === 0) {
                    item += this.capitalize(randomWord);
                } else {
                    item += ' ' + randomWord;
                }
            }
            
            item += '.';
            
            if (includeFormatting && Math.random() > 0.7) {
                item = this.addFormatting(item);
            }
            
            listItems.push('• ' + item);
        }
        
        return listItems.join('\n');
    }

    generateSentence(variant, capitalizeFirst = false) {
        const words = this.loremData[variant];
        const wordCount = this.getRandomInt(5, 15);
        let sentence = '';
        
        for (let i = 0; i < wordCount; i++) {
            const randomWord = words[Math.floor(Math.random() * words.length)];
            if (i === 0 && capitalizeFirst) {
                sentence += this.capitalize(randomWord);
            } else {
                sentence += ' ' + randomWord;
            }
        }
        
        // Add random punctuation
        const punctuations = ['.', '!', '?'];
        const punctuation = punctuations[Math.floor(Math.random() * punctuations.length)];
        
        return sentence.trim() + punctuation;
    }

    getLoremStart(variant) {
        const starts = {
            standard: "lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua",
            classic: "sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem aperiam eaque",
            modern: "leverage agile frameworks to provide a robust synopsis for high level overviews iterative approaches to corporate strategy",
            tech: "binary algorithms and scalable frameworks provide robust solutions for modern cloud-based applications and database management",
            hipster: "artisan craft coffee sustainable organic locavore vinyl retro aesthetic minimal vintage authentic slow-carb meggings vegan",
            cupcake: "cupcake dessert pastry chocolate vanilla caramel frosting sprinkles sweet sugar delicious treat yummy scrumptious mouthwatering"
        };
        
        return starts[variant] || starts.standard;
    }

    addFormatting(text) {
        const words = text.split(' ');
        const boldWordIndex = Math.floor(Math.random() * (words.length - 3)) + 1;
        const italicWordIndex = Math.floor(Math.random() * (words.length - 3)) + 1;
        
        if (words[boldWordIndex]) {
            words[boldWordIndex] = `<strong>${words[boldWordIndex]}</strong>`;
        }
        
        if (words[italicWordIndex] && italicWordIndex !== boldWordIndex) {
            words[italicWordIndex] = `<em>${words[italicWordIndex]}</em>`;
        }
        
        return words.join(' ');
    }

    addLinks(text, variant) {
        const domains = {
            standard: ["example.com", "loremipsum.io", "dummytext.org"],
            classic: ["cicero.org", "latintext.edu", "ancientrome.com"],
            modern: ["business.com", "corporate.io", "enterprise.org"],
            tech: ["github.com", "stackoverflow.com", "digitalocean.com"],
            hipster: ["etsy.com", "pinterest.com", "kickstarter.com"],
            cupcake: ["baking.com", "dessert.org", "sweettooth.io"]
        };
        
        const domain = domains[variant][Math.floor(Math.random() * domains[variant].length)];
        const linkText = this.loremData[variant][Math.floor(Math.random() * this.loremData[variant].length)];
        
        return text.replace(new RegExp(`\\b${linkText}\\b`, 'i'), 
                           `<a href="https://${domain}" target="_blank">${linkText}</a>`);
    }

    addRandomLists(variant) {
        const listCount = this.getRandomInt(1, 2);
        let lists = '\n\n';
        
        for (let i = 0; i < listCount; i++) {
            const itemCount = this.getRandomInt(3, 6);
            lists += 'Key features:\n';
            
            for (let j = 0; j < itemCount; j++) {
                const wordCount = this.getRandomInt(2, 5);
                let item = '• ';
                const words = this.loremData[variant];
                
                for (let k = 0; k < wordCount; k++) {
                    const randomWord = words[Math.floor(Math.random() * words.length)];
                    if (k === 0) {
                        item += this.capitalize(randomWord);
                    } else {
                        item += ' ' + randomWord;
                    }
                }
                
                lists += item + '\n';
            }
            
            lists += '\n';
        }
        
        return lists;
    }

    updateOutput(text, type, quantity) {
        const outputElement = document.getElementById('outputText');
        outputElement.value = text;
        outputElement.classList.add('text-generated');
        
        setTimeout(() => outputElement.classList.remove('text-generated'), 500);

        // Update statistics
        const words = text.split(/\s+/).filter(word => word.length > 0);
        const chars = text.length;
        const paragraphs = text.split(/\n\n/).filter(para => para.trim().length > 0);

        document.getElementById('wordCount').textContent = `Words: ${words.length}`;
        document.getElementById('charCount').textContent = `Characters: ${chars}`;
        document.getElementById('paraCount').textContent = `Paragraphs: ${paragraphs.length}`;
    }

    copyText() {
        const outputText = document.getElementById('outputText');
        
        if (!outputText.value.trim()) {
            this.showError('No text to copy. Please generate some Lorem Ipsum first.');
            return;
        }

        outputText.select();
        navigator.clipboard.writeText(outputText.value).then(() => {
            this.showSuccess('Lorem Ipsum copied to clipboard!');
        }).catch(() => {
            this.showError('Failed to copy text to clipboard.');
        });
    }

    loadTemplate(templateElement) {
        const type = templateElement.getAttribute('data-type');
        const quantity = templateElement.getAttribute('data-quantity');
        const variant = templateElement.getAttribute('data-variant');

        document.getElementById('textType').value = type;
        document.getElementById('quantity').value = quantity;
        document.getElementById('loremVariant').value = variant;

        setTimeout(() => this.generateLoremIpsum(), 100);
    }

    clearAll() {
        document.getElementById('outputText').value = '';
        document.getElementById('wordCount').textContent = 'Words: 0';
        document.getElementById('charCount').textContent = 'Characters: 0';
        document.getElementById('paraCount').textContent = 'Paragraphs: 0';
        this.hideError();
        this.hideSuccess();
    }

    // Utility functions
    capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    showError(message) {
        this.hideSuccess();
        const errorElement = document.createElement('div');
        errorElement.className = 'error-message';
        errorElement.innerHTML = `<i class="fas fa-exclamation-triangle"></i> ${message}`;
        errorElement.style.display = 'flex';
        
        const calculator = document.querySelector('.calculator');
        const existingError = calculator.querySelector('.error-message');
        if (existingError) existingError.remove();
        
        calculator.appendChild(errorElement);
        
        setTimeout(() => {
            errorElement.remove();
        }, 5000);
    }

    showSuccess(message) {
        this.hideError();
        const successElement = document.createElement('div');
        successElement.className = 'success-message';
        successElement.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
        successElement.style.display = 'flex';
        
        const calculator = document.querySelector('.calculator');
        const existingSuccess = calculator.querySelector('.success-message');
        if (existingSuccess) existingSuccess.remove();
        
        calculator.appendChild(successElement);
        
        setTimeout(() => {
            successElement.remove();
        }, 3000);
    }

    hideError() {
        const errorElement = document.querySelector('.error-message');
        if (errorElement) errorElement.remove();
    }

    hideSuccess() {
        const successElement = document.querySelector('.success-message');
        if (successElement) successElement.remove();
    }
}

// Initialize the Lorem Ipsum Generator when the page loads
document.addEventListener('DOMContentLoaded', () => {
    new LoremIpsumGenerator();
});

// Service Worker for offline functionality
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js').then(function(registration) {
            console.log('ServiceWorker registration successful');
        }, function(err) {
            console.log('ServiceWorker registration failed: ', err);
        });
    });
}