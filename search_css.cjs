const fs = require('fs');
const content = fs.readFileSync('public/css/style.css', 'utf8');

const lines = content.split('\n');
console.log('Total lines in style.css:', lines.length);

console.log('=== Searching for hero-full ===');
for (let i = 0; i < lines.length; i++) {
    if (lines[i].includes('hero-full')) {
        console.log(`Line ${i+1}: ${lines[i].trim()}`);
    }
}

console.log('=== Searching for animate ===');
for (let i = 0; i < lines.length; i++) {
    if (lines[i].includes('animate')) {
        console.log(`Line ${i+1}: ${lines[i].trim()}`);
    }
}
