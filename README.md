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

## SQL Advance
### Instruction
- Untuk nilai RT menggunakan *materi_uji_id 7*, tetapi tidak mengikutkan *pelajaran_khusus*
- Untuk nilai ST menggunakan *materi_uji_id 4*
    - untuk *pelajaran_id 44 dikali 41.67*
    - untuk *pelajaran_id 45 dikali 29.67*
    - untuk *pelajaran_id 46 dikali 100*
    - untuk *pelajaran_id 47 dikali 23.81*
    - hasil akhir harus diurutkan dari total nilai terbesar

### /nilaiRT
```
{
    "status": "success",
    "data": [
        {
            "nama": "Ahmad Fadlan",
            "nisn": "3097012709",
            "nilaiRT": {
                "REALISTIC": "4",
                "INVESTIGATIVE": "2",
                "ARTISTIC": "2",
                "SOCIAL": "2",
                "ENTERPRISING": "4",
                "CONVENTIONAL": "2"
            }
        }
    ]
}
```
### /nilaiST
```
[
    {
    "nama": "Muhammad Sanusi",
    "nisn": "0094494403",
    "listNilai": {
        "Verbal": 208.35,
        "Kuantitatif": 89.01,
        "Penalaran": 200,
        "Figural": 142.86
        },
    "total": 640.22
    }
]
```
