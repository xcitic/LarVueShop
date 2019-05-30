### Infrastructure of for the Project
This folder contains the docker files for the infrastructure of the project.
It may also contain build information for different modules if there are special steps to build parts of the application.


## Dependencies
docker-compose is the only dependency.
sudo apt get install docker-compose


## How to Setup
# Create .env file for your environment variables
```bash
cp .env-example .env
```

Fill out the fields in the .env file with the name, username, password and the port to expose.
If running locally set localhost as the DB_HOST.
If you already have postgres locally, then use another port than 5432 to expose the docker container, or else it will crash with the running service.

# Run the docker services
```bash
docker-compose up
```

## Main Components
Database: Docker container with Postgresql
    --> Container name aliased to: postgres
