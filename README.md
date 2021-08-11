# slavic-fauxamis / False Friends in Slavic Languages
[![DOI](https://zenodo.org/badge/DOI/10.5281/zenodo.5178553.svg)](https://doi.org/10.5281/zenodo.5178553)
## About
This database system is a collection of 'false friends' (shared words having different meanings) between Slavic languages, e.g. Russian–Polish, Macedonian–Upper Sorbian, Belarusian–Serbian, etc.

[Read more about the database here](https://pod-o-mart.github.io/slavic-fauxamis).

The database system was initially published in 2020 on the [Danish Portal for Slavonic, Balkan and East European Studies](https://oesteuropastudier.dk/en/dictionaries/fauxamis). As I do not have the ressources to maintain the code anymore, I have decided to publish the code on Github to anyone.

## Installation
- Download the the [MySLQ database](https://github.com/pod-o-mart/slavic-fauxamis/files/6941287/falsefriends_.sql.zip) and unzip it
- Import the SQL database (utf8_general_ci) to your MySQL server. Create a user for the database
- Copy all files from this Github repository to a folder of your choice on your server/webspace
- Edit the file db.php, declare hostname, MySQL username, MySQL userpassword
- point with your browser to index.php in the folder of your choice of your server/webspace

## Copyrights
Author of this database: <a href="https://github.com/pod-o-mart/" target="_blank">Martin Podolak</a>.

This database is a derivate from the Wikibooks project "<a href="https://en.wikibooks.org/wiki/False_Friends_of_the_Slavist" target="_blank">False Friends of the Slavist</a>", created by <a href="https://slavistik.phil-fak.uni-koeln.de/buncic" target="_blank">Daniel Bunčić</a> (with the support of <a href="https://en.wikibooks.org/wiki/False_Friends_of_the_Slavist#Pre-Wikibook_contributors" target="_blank">others</a>), who granted the <a href="https://en.wikipedia.org/wiki/GNU_Free_Documentation_License" target="_blank">GNU Free Documentation License</a> for his work. Consequently, this database is published under the same conditions:

> Permission is granted to copy, distribute and/or modify this document under the terms of the *<a href="https://en.wikipedia.org/wiki/GNU_Free_Documentation_License" target="_blank">GNU Free Documentation License</a>*, Version 1.2 or any later version published by the <a href="https://en.wikipedia.org/wiki/Free_Software_Foundation" target="_blank">Free Software Foundation</a>; with no Invariant Sections, no Front-Cover Texts, and no Back-Cover Texts. A copy of the license is included in the section entitled "<a href="https://en.wikibooks.org/wiki/GNU_Free_Documentation_License" target="_blank">GNU Free Documentation License</a>."
