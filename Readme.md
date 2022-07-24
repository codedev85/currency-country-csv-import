Usage 

on Valet Installation 

1 . http://country_code.test/src 

will load the homepage and allow access to import the country codes
sql structure is added to the project as well 

a.) country_data.sql for importing countries 
b.) currency_data.sql for importing currencies


2.) To import currencies
    http://country_code.test/src/currency.php
    sql structure : currency_data.sql 

3.) Database Base setup :
    In config/Database.php 
    add database credentials 

4.) Api's
    To fetch Country data :
    http://country_code.test/src/api/Country/readFile.php
    To fetch Currency Data;
    http://country_code.test/src/api/Currency/getData.php

5.) Pagination helpers
    To fetch Countries Api with Pagination
    Example : Note the integer passed is the starting point to fetch the rest if the data
    http://country_code.test/src/api/Country/readFile.php?page=5
    To fetch Currency Data
    http://country_code.test/src/api/Currency/getData.php?page=15

6.) Search Capabilities 
    Method : Post Method :
    post data :search_data ;
    Searchable Key : official_name 
    Endpoints :
    Filter Country with a post request of search_data
    http://country_code.test/src/api/Country/filterCountry.php
    Filter Currency with a post request of search_data
    http://country_code.test/src/api/Currency/FilterCurrency.php
