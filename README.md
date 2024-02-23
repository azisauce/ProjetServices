  <h3 align="center">SwiftServe</h3>

  <p align="center">
    A Good Service
    
  </p>
<!-- ABOUT THE Service -->

## About The Service

A web app where you can find what you need in case of urgency eascily, you can check yourself.

Features:

-   Commons
    -   Explore Services
    -   Profile
    -   Message
    -   Inbox
-   Helper
    -   Service Publications (Create posts - Update posts - Delete posts)
    -   Service Box (to Organize Service)
    -   respond to users
-   User
    -   Apply Service
    -   Service Box (to See current Apply/Ongoing/Finished Services)
    -   Wishlist Service
-   Experiment
    -   Adaptive while being Responsive (Mobile version is Mobile Apps-like)

### Built With

-   [Laravel](https://laravel.com/)
    - [PHPv7.2.5]
-   [VueJS](https://vuejs.org/)
    - [NodeJSv14.21.3]
-   [Sass](https://sass-lang.com/)

<!-- GETTING STARTED -->

## Getting Started

To get a local copy up and running follow these simple steps.

### Prerequisites

-   [npm](https://nodejs.org/)
    !!! You may face some problems here, you need to install [nvm] first (In case you have NodeJS installed delete it)
    !!! With nvm you can install the right version of nodeJS and the compatible version of npm
-   [composer](https://getcomposer.org/download/)
-   AMP stack
    -   Apache HTTP Server
    -   MySQL
    -   [PHP](https://www.php.net/downloads)

### Installation

1. Clone the repo
    ```sh
    git clone [URL]
    ```
2. Get into the Service
    ```sh
    cd ProjetServices
    ```
3. Install the frontend packages (NPM)
    ```sh
    npm install
    ```
4. Install the backend packages
    ```sh
    composer install
    ```

<!-- USAGE EXAMPLES -->

## Usage

1. Make `.env` file by copy the `.env.example`
    ```sh
    cp .env.example .env
    ```
2. Edit `.env` file to setup database connection
    ```dosini
    DB_DATABASE=db_name
    DB_USERNAME=user_to_access_the_db
    DB_PASSWORD=user_password
    ```
3. Set application key
    ```sh
    php artisan key:generate
    ```
4. Create tables using migration with dummy data
    ```sh
    php artisan migrate:fresh --seed
    ```
5. Create the frontend production ready files
    ```sh
    npm run prod
    ```
6. Run the app
    ```sh
    php artisan serve
    ```
7. Try dummy account

    ```dosini
    # user
    username = student@example.com
    password = password

    # helper
    username = lecturer@example.ac.id
    password = password
    ```

<!-- ROADMAP -->


## Contributing

A team of: Aziz Turki, Rhaiem Marwen, Arij Zahi, Ghada Amri, Baha Ben Slama, Adem Ben hassen


<!-- LICENSE -->


## Contact

Team:

-   You can contact us with our outlook accounts


<!-- ACKNOWLEDGEMENTS -->


