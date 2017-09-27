# C.B.U.L.M.S.
Some bullshit that needs to be done because our layfs depend on it
## Installation
1. Clone
 ```
    git clone https://github.com/kethxenn/C.B.U.L.M.S..git
 ```
2. Install dependencies
 
    ``` composer install ```

    ``` npm install ```
    
    ``` npm run dev ```

3. Reconfigure .env file    
4. Create empty database called cbulms
5. Populate db with data

    ``` php artisan migrate ```

    ``` php artisan db:seed ```
    
And you're all set. Type

    ``` php artisan serve ```
    
to run this shit
