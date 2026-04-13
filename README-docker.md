Github link: https://github.com/Chilitooo/DRGES-Tracker / https://github.com/Chilitooo/DRGES-Tracker.git
Install Docker desktop: https://www.docker.com/

- Create folder in your directory and inside that create docker-compose.yml file (save it as all not as text document)
- Go to my github link and find docker-compose.yml copy and paste the code into your created file

- Open Docker desktop
- After that run this command in your terminal: docker compose up
- Open the Docker desktop and find the drges_app then click the port/s (example: 8000:80)

- If there is error(500), run this command : 
docker exec drges_app php artisan migrate --force

- Run again: docker compose up

- Create admin account (if don't have account)
- Run this command: docker exec -it your_app php artisan tinker
(for example)
> \App\Models\User::create(['name' => 'Admin', 'email' => 'admin@carsu.edu.ph', 'password' => bcrypt('password123'), 'role' => 'admin', 'status' => 'active']);   


