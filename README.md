# url-shortener
URL shortener

I decided to learn PHP by coding and it's MVP for URL shortener.

On the index.php you paste the URL, then click "Cut!". Script checks if URL exists and shows you short URL if so. Else script makes a database row with new URL and token for short link, then gives you new short ling. I also wrote a token generator which generates unique token and uses recursion for checking uniqueness.
Short link consist of https://url.com?s=key, where key is a token of short link. Script analyse GET parameter and searches for a token in database. If token is found, script redirects you to the desired page. If there's no token found, script shows you an error and input field for long URL.
Database consists of 3 columns: token [varchar(10)], long_url[varchar(255)], created[(date)]. Column "created" is used for MySQL's event_scheduler to delete old rows.
Used: PHP 8.2, MySQL, Ubuntu 22.04, PHPStorm, Git (from terminal).
