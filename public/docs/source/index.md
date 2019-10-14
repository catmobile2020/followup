---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost:8000/docs/collection.json)

<!-- END_INFO -->

#general
<!-- START_b8ad2c5296ebb5e71395df384b3746a4 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/healthyTips" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/healthyTips",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [],
    "state": 1
}
```

### HTTP Request
`GET api/v1/healthyTips`

`HEAD api/v1/healthyTips`


<!-- END_b8ad2c5296ebb5e71395df384b3746a4 -->

<!-- START_82ffae97117b41b109036aa361e9b21e -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/healthyTips" \
-H "Accept: application/json" \
    -d "title"="praesentium" \
    -d "body"="praesentium" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/healthyTips",
    "method": "POST",
    "data": {
        "title": "praesentium",
        "body": "praesentium"
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/healthyTips`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    title | string |  required  | Minimum: `10`
    body | string |  required  | 

<!-- END_82ffae97117b41b109036aa361e9b21e -->

<!-- START_3ee7613f38e356357abea2b83134e094 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/healthyTips/{healthyTip}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/healthyTips/{healthyTip}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": "Doesn't exists any healthytip With this indicator",
    "state": 0
}
```

### HTTP Request
`GET api/v1/healthyTips/{healthyTip}`

`HEAD api/v1/healthyTips/{healthyTip}`


<!-- END_3ee7613f38e356357abea2b83134e094 -->

<!-- START_422ab5d85d9373d4af4fa3b077ce4116 -->
## Remove the specified resource from storage.

> Example request:

```bash
curl -X DELETE "http://localhost:8000/api/v1/healthyTips/{healthyTip}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/healthyTips/{healthyTip}",
    "method": "DELETE",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE api/v1/healthyTips/{healthyTip}`


<!-- END_422ab5d85d9373d4af4fa3b077ce4116 -->

<!-- START_0528d2161dc4f15f79ac142a947e1e6f -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/notifications" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/notifications",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "id": 1,
            "type": "Events",
            "notifiable_id": 1,
            "notifiable_type": "App\\Event",
            "created_at": "2018-03-25 14:07:13",
            "updated_at": "2018-03-25 14:07:13",
            "notifiable": {
                "id": 1,
                "title": "Event test",
                "body": "<p>Testing <\/p>",
                "location": "Cairo Conference , Cairo, Egypt",
                "event_date": "30-03-2018",
                "created_at": "2018-03-25 14:07:11",
                "updated_at": "2018-03-27 10:27:42"
            }
        }
    ],
    "state": 1
}
```

### HTTP Request
`GET api/v1/notifications`

`HEAD api/v1/notifications`


<!-- END_0528d2161dc4f15f79ac142a947e1e6f -->

<!-- START_033364595d81db71d178f84bc4db8ea2 -->
## Display the specified resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/notifications/{notification}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/notifications/{notification}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET api/v1/notifications/{notification}`

`HEAD api/v1/notifications/{notification}`


<!-- END_033364595d81db71d178f84bc4db8ea2 -->

<!-- START_c233fc34839427dff7ef9ad7c3821ae3 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/offers" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/offers",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [],
    "state": 1
}
```

### HTTP Request
`GET api/v1/offers`

`HEAD api/v1/offers`


<!-- END_c233fc34839427dff7ef9ad7c3821ae3 -->

<!-- START_b080d3aee6b5aa058eefcd0265db2c6f -->
## api/v1/offers/{offer}

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/offers/{offer}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/offers/{offer}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": "Doesn't exists any offer With this indicator",
    "state": 0
}
```

### HTTP Request
`GET api/v1/offers/{offer}`

`HEAD api/v1/offers/{offer}`


<!-- END_b080d3aee6b5aa058eefcd0265db2c6f -->

<!-- START_85d954e6e09186ddbbc9e8cfa934efc1 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/events" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/events",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "id": 1,
            "title": "Event test",
            "body": "<p>Testing <\/p>",
            "location": "Cairo Conference , Cairo, Egypt",
            "event_date": "30-03-2018",
            "created_at": "2018-03-25 14:07:11",
            "updated_at": "2018-03-27 10:27:42",
            "photos": [
                {
                    "id": 11,
                    "path": "uploads\/1batman_logo-wallpaper-1920x1080.jpg",
                    "imageable_id": 1,
                    "imageable_type": "App\\Event",
                    "created_at": "2018-03-25 14:07:13",
                    "updated_at": "2018-03-25 14:07:13"
                }
            ]
        }
    ],
    "state": 1
}
```

### HTTP Request
`GET api/v1/events`

`HEAD api/v1/events`


<!-- END_85d954e6e09186ddbbc9e8cfa934efc1 -->

<!-- START_a4e4e92893f437f3bd898bc2a5b3f2b2 -->
## api/v1/events/{event}

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/events/{event}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/events/{event}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "id": 1,
        "title": "Event test",
        "body": "<p>Testing <\/p>",
        "location": "Cairo Conference , Cairo, Egypt",
        "event_date": "30-03-2018",
        "created_at": "2018-03-25 14:07:11",
        "updated_at": "2018-03-27 10:27:42",
        "photos": [
            {
                "id": 11,
                "path": "uploads\/1batman_logo-wallpaper-1920x1080.jpg",
                "imageable_id": 1,
                "imageable_type": "App\\Event",
                "created_at": "2018-03-25 14:07:13",
                "updated_at": "2018-03-25 14:07:13"
            }
        ]
    },
    "state": 1
}
```

### HTTP Request
`GET api/v1/events/{event}`

`HEAD api/v1/events/{event}`


<!-- END_a4e4e92893f437f3bd898bc2a5b3f2b2 -->

<!-- START_8ae5d428da27b2b014dc767c2f19a813 -->
## api/v1/register

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/register" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/register",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/register`


<!-- END_8ae5d428da27b2b014dc767c2f19a813 -->

<!-- START_8c0e48cd8efa861b308fc45872ff0837 -->
## api/v1/login

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/login" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/login",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/login`


<!-- END_8c0e48cd8efa861b308fc45872ff0837 -->

<!-- START_3071283983ea4522692db5293fe52526 -->
## api/v1/update-user-image

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/update-user-image" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/update-user-image",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/update-user-image`


<!-- END_3071283983ea4522692db5293fe52526 -->

<!-- START_9dfbf955a7a50eaaafbeb565c2fe73ce -->
## api/v1/change-program

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/change-program" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/change-program",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/change-program`


<!-- END_9dfbf955a7a50eaaafbeb565c2fe73ce -->

<!-- START_adb19a64d16508318719cf1dd5911107 -->
## api/v1/get-user-program

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/get-user-program" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/get-user-program",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/get-user-program`


<!-- END_adb19a64d16508318719cf1dd5911107 -->

<!-- START_dd6e4cd9e54d276b1be80ad9a99ecfaf -->
## api/v1/get-user-progress

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/get-user-progress" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/get-user-progress",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/get-user-progress`


<!-- END_dd6e4cd9e54d276b1be80ad9a99ecfaf -->

<!-- START_5e439c079751c4606fcbb9d5baace52a -->
## api/v1/confirm-schedule

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/confirm-schedule" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/confirm-schedule",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/confirm-schedule`


<!-- END_5e439c079751c4606fcbb9d5baace52a -->

<!-- START_c90bdf237ddd2de64c11674cf85db8a7 -->
## api/v1/get-current-day

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/get-current-day" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/get-current-day",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/get-current-day`


<!-- END_c90bdf237ddd2de64c11674cf85db8a7 -->

<!-- START_c7a1221fc727c2bd90510c179901edec -->
## api/v1/change-password

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/change-password" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/change-password",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/change-password`


<!-- END_c7a1221fc727c2bd90510c179901edec -->

<!-- START_922d2cf6e3e8225cbcb4ddb3e78520b6 -->
## api/v1/update-player-id

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/update-player-id" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/update-player-id",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/update-player-id`


<!-- END_922d2cf6e3e8225cbcb4ddb3e78520b6 -->

<!-- START_1a2ab4cb5eb36851c25749b48752c0de -->
## api/v1/user-info

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/user-info" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/user-info",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/user-info`


<!-- END_1a2ab4cb5eb36851c25749b48752c0de -->

<!-- START_3486a635bcdc75ca6c680ad4c2e7f07b -->
## api/v1/update-user

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/update-user" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/update-user",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/update-user`


<!-- END_3486a635bcdc75ca6c680ad4c2e7f07b -->

<!-- START_682263f3737810a95fba186875ea9520 -->
## api/v1/user-track

> Example request:

```bash
curl -X POST "http://localhost:8000/api/v1/user-track" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/user-track",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST api/v1/user-track`


<!-- END_682263f3737810a95fba186875ea9520 -->

<!-- START_a7dbb997321672547bff79bbd22fbc0d -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/programs" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/programs",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "id": 2,
            "title": "Weight Gain",
            "brief": "change",
            "active": 1,
            "created_at": "2018-03-25 11:12:48",
            "updated_at": "2018-03-25 11:12:48",
            "photos": [
                {
                    "id": 7,
                    "path": "uploads\/21521976368.jpg",
                    "imageable_id": 2,
                    "imageable_type": "App\\Program",
                    "created_at": "2018-03-25 11:12:48",
                    "updated_at": "2018-03-25 11:12:48"
                }
            ]
        },
        {
            "id": 1,
            "title": "Weight Loss",
            "brief": "Just testing",
            "active": 1,
            "created_at": "2018-03-22 13:12:57",
            "updated_at": "2018-03-22 13:12:57",
            "photos": [
                {
                    "id": 2,
                    "path": "uploads\/11521724377.png",
                    "imageable_id": 1,
                    "imageable_type": "App\\Program",
                    "created_at": "2018-03-22 13:12:57",
                    "updated_at": "2018-03-22 13:12:57"
                }
            ]
        }
    ],
    "state": 1
}
```

### HTTP Request
`GET api/v1/programs`

`HEAD api/v1/programs`


<!-- END_a7dbb997321672547bff79bbd22fbc0d -->

<!-- START_70e8e8bfe9ff9bd02e12e16ceb9ff46f -->
## api/v1/programs/{program}

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/programs/{program}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/programs/{program}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "id": 1,
        "title": "Weight Loss",
        "brief": "Just testing",
        "active": 1,
        "created_at": "2018-03-22 13:12:57",
        "updated_at": "2018-03-22 13:12:57",
        "photos": [
            {
                "id": 2,
                "path": "uploads\/11521724377.png",
                "imageable_id": 1,
                "imageable_type": "App\\Program",
                "created_at": "2018-03-22 13:12:57",
                "updated_at": "2018-03-22 13:12:57"
            }
        ],
        "schedules": [
            {
                "id": 1,
                "title": "First Day",
                "brief": "first day testing",
                "active": 1,
                "program_id": 1,
                "order": null,
                "created_at": "2018-03-22 13:27:19",
                "updated_at": "2018-03-22 13:27:19"
            },
            {
                "id": 2,
                "title": "Second Day",
                "brief": "just checking",
                "active": 1,
                "program_id": 1,
                "order": null,
                "created_at": "2018-03-25 09:10:21",
                "updated_at": "2018-03-25 09:10:21"
            },
            {
                "id": 3,
                "title": "third day",
                "brief": "testing",
                "active": 1,
                "program_id": 1,
                "order": null,
                "created_at": "2018-03-25 11:12:25",
                "updated_at": "2018-03-25 11:12:25"
            }
        ]
    },
    "state": 1
}
```

### HTTP Request
`GET api/v1/programs/{program}`

`HEAD api/v1/programs/{program}`


<!-- END_70e8e8bfe9ff9bd02e12e16ceb9ff46f -->

<!-- START_06e017ecb132f0ab14b3182f87875fa6 -->
## api/v1/schedules

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/schedules" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/schedules",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "id": 1,
            "title": "First Day",
            "brief": "first day testing",
            "active": 1,
            "program_id": 1,
            "order": null,
            "created_at": "2018-03-22 13:27:19",
            "updated_at": "2018-03-22 13:27:19",
            "photos": [
                {
                    "id": 3,
                    "path": "uploads\/11521725239.jpg",
                    "imageable_id": 1,
                    "imageable_type": "App\\Schedule",
                    "created_at": "2018-03-22 13:27:19",
                    "updated_at": "2018-03-22 13:27:19"
                }
            ]
        },
        {
            "id": 2,
            "title": "Second Day",
            "brief": "just checking",
            "active": 1,
            "program_id": 1,
            "order": null,
            "created_at": "2018-03-25 09:10:21",
            "updated_at": "2018-03-25 09:10:21",
            "photos": [
                {
                    "id": 5,
                    "path": "uploads\/2imac-40.jpg",
                    "imageable_id": 2,
                    "imageable_type": "App\\Schedule",
                    "created_at": "2018-03-25 09:10:21",
                    "updated_at": "2018-03-25 09:10:36"
                }
            ]
        },
        {
            "id": 3,
            "title": "third day",
            "brief": "testing",
            "active": 1,
            "program_id": 1,
            "order": null,
            "created_at": "2018-03-25 11:12:25",
            "updated_at": "2018-03-25 11:12:25",
            "photos": [
                {
                    "id": 6,
                    "path": "uploads\/31521976345.jpg",
                    "imageable_id": 3,
                    "imageable_type": "App\\Schedule",
                    "created_at": "2018-03-25 11:12:25",
                    "updated_at": "2018-03-25 11:12:25"
                }
            ]
        },
        {
            "id": 4,
            "title": "First Day",
            "brief": "test again",
            "active": 1,
            "program_id": 2,
            "order": null,
            "created_at": "2018-03-25 11:13:09",
            "updated_at": "2018-03-25 11:13:09",
            "photos": [
                {
                    "id": 8,
                    "path": "uploads\/41521976389.jpg",
                    "imageable_id": 4,
                    "imageable_type": "App\\Schedule",
                    "created_at": "2018-03-25 11:13:09",
                    "updated_at": "2018-03-25 11:13:09"
                }
            ]
        }
    ],
    "state": 1
}
```

### HTTP Request
`GET api/v1/schedules`

`HEAD api/v1/schedules`


<!-- END_06e017ecb132f0ab14b3182f87875fa6 -->

<!-- START_c6d6307c83ee3a36556b7b2c660798e5 -->
## api/v1/schedules/{schedule}

> Example request:

```bash
curl -X GET "http://localhost:8000/api/v1/schedules/{schedule}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost:8000/api/v1/schedules/{schedule}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "id": 1,
        "title": "First Day",
        "brief": "first day testing",
        "active": 1,
        "program_id": 1,
        "order": null,
        "created_at": "2018-03-22 13:27:19",
        "updated_at": "2018-03-22 13:27:19",
        "photos": [
            {
                "id": 3,
                "path": "uploads\/11521725239.jpg",
                "imageable_id": 1,
                "imageable_type": "App\\Schedule",
                "created_at": "2018-03-22 13:27:19",
                "updated_at": "2018-03-22 13:27:19"
            }
        ],
        "meals": [
            {
                "id": 1,
                "schedule_id": 1,
                "title": "Breakfast",
                "body": "2eggs \r\n\r\n265 g white cheese",
                "active": 1,
                "created_at": "2018-03-22 13:28:43",
                "updated_at": "2018-03-22 13:28:43",
                "photos": [
                    {
                        "id": 4,
                        "path": "uploads\/1annual-book.jpg",
                        "imageable_id": 1,
                        "imageable_type": "App\\Meal",
                        "created_at": "2018-03-22 13:28:43",
                        "updated_at": "2018-03-22 13:29:35"
                    }
                ]
            }
        ],
        "exercises": []
    },
    "state": 1
}
```

### HTTP Request
`GET api/v1/schedules/{schedule}`

`HEAD api/v1/schedules/{schedule}`


<!-- END_c6d6307c83ee3a36556b7b2c660798e5 -->

