# small-task

### Requirements
- [Docker](https://docs.docker.com/install/)
- [docker-compose](https://docs.docker.com/compose/install/)

### Run
- `sudo -H -uroot bash build.sh`

> Before you run above command, make sure no server is running in port `8080` or `8081`.

### Access
- Get DB access `http://0.0.0.0:8081/`
- Get API access `http://0.0.0.0:8080/`

### API
Supported API's are following:
- `POST api/task` to create task
- `PUT api/task/{taskId}` to update existing task
- `GET task/list` to access all task created by all users

