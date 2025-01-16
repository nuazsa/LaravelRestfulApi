# Employee Management API

> An API designed to manage employee information efficiently and effectively.

## Endpoint
`https://laravelrestfulapi-production.up.railway.app`
### Login
- URL
    - `/login`
- Method
    - `POST`
- Request Body
```
{
    "username": "admin",
    "password": "pastibisa",
}
```
- Response
```
{
    "status": "success / error",
    "message": "pesan sukses / error",
    "data": {
        "token": "token untuk autentikasi",
        "admin": {
            "id": "uuid admin",
            "name": "nama admin",
            "username": "username admin",
            "phone": "no telepon admin",
            "email": "email admin",
        },
    }
}

```

### Get All Division Data
- URL
    - `/divisions`
- Method
    - `GET`
- Headers
    - `Authorization`: `<token>`
- Request Param
```
{
    "name": "pencarian nama",
}
```
- Response
```
{
    "status": "success / error",
    "message": "pesan sukses / error",
    "data": {
        "divisions": [
            {
                "id": "uuid divisi",
                "name": "nama divisi",
            },
            {
                "id": "uuid divisi",
                "name": "nama divisi",
            }
        ],
    },
    "pagination": {
        "berisikan attribute pagination laravel":"..."
    },
}
```

### Get All Employee Data
- URL
    - `/employees`
- Method
    - `GET`
- Headers
    - `Authorization`: `<token>`
- Request Param
```
{
    "name": "pencarian nama",
    "division_id": "filter berdasarkan divisi",
}
```
- Response
```
{
    "status": "success / error",
    "message": "pesan sukses / error",
    "data": {
        "employees": [
            {
                "id": "uuid pegawai",
                "image": "url foto pegawai",
                "name": "nama pegawai",
                "phone": "no telepon pegawai",
                "division": {
                    "id": "uuid divisi",
                    "name": "nama divisi"
                },
                "position": "jabatan pegawai",
            },
            {
                "id": "uuid pegawai",
                "image": "url foto pegawai",
                "name": "nama pegawai",
                "phone": "no telepon pegawai",
                "division": {
                    "id": "uuid divisi",
                    "name": "nama divisi"
                },
                "position": "jabatan pegawai",
            }
        ],
    },
    "pagination": {
        "berisikan attribute pagination laravel":"..."
    },
}
```

### Create Employee Data
- URL
    - `/employees`
- Method
    - `POST`
- Headers
    - `Authorization`: `<token>`
- Request Body
```
{
    "image": "file foto pegawai",
    "name": "nama pegawai",
    "phone": "no telepon pegawai",
    "division": "uuid divisi",
    "position": "jabatan pegawai",
}
```
- Response
```
{
    "status": "success / error",
    "message": "pesan sukses / error",
}
```

### Update Employee Data
- URL
    - `/employees/{uuid employee}`
- Method
    - `PUT`
- Headers
    - `Authorization`: `<token>`
- Request Body
```
{
    "image": "file foto pegawai",
    "name": "nama pegawai",
    "phone": "no telepon pegawai",
    "division": "uuid divisi",
    "position": "jabatan pegawai",
}
```
- Response
```
{
    "status": "success / error",
    "message": "pesan sukses / error",
}
```

### Delete Employee Data
- URL
    - `/employees/{uuid employee}`
- Method
    - `PUT`
- Headers
    - `Authorization`: `<token>`
- Response
```
{
    "status": "success / error",
    "message": "pesan sukses / error",
}
```

### Logout
- URL
    - `/logout`
- Method
    - `POST`
- Headers
    - `Authorization`: `<token>`
- Response
```
{
    "status": "success / error",
    "message": "pesan sukses / error",
}
```
