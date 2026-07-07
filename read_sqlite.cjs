const sqlite3 = require('sqlite3').verbose();
const db = new sqlite3.Database('database/database.sqlite');

db.all("SELECT key, value FROM settings WHERE key LIKE 'join%'", [], (err, rows) => {
    if (err) {
        console.error(err);
        return;
    }
    rows.forEach(row => {
        console.log(`Key: ${row.key}`);
        console.log(`Value: ${row.value}`);
    });
    db.close();
});
