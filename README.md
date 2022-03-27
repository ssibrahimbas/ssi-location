<p align="center"><br><img src="https://avatars.githubusercontent.com/u/76786120?v=4" width="128" height="128" style="border-radius: 50px;" /></p>
<h3 align="center">Ssibrahimbas location-app</h3>
<p align="center">
  With this API you can currently add, list, filter, delete and update countries and cities.
</p>

<br>

<hr>

### Endpoints

<details>
<summary>Create Country</summary>

You can add country with this endpoint.

<br>

#### Parameters

| Parameter    | Is Required | Type   |
|--------------|-------------|--------|
| **name**     | *true*      | string |
| **langCode** | *true*      | string |

<br>

#### Returns

> is success
>
> ```json
> {
>   "success": true,
>   "message": "Country successfully created"
> }
> ```

> Validation Error
>
> ```json
> {
>    "success": false,
>    "message": "Validation Error",
>    "data": [
>       {
>          "field": "name",
>          "message": "name field is required"
>       }
>    ]
> }
> ```

> Authorization Error
>
> ```json
> {
>     "success": false,
>     "message": "You must be logged in to access this page"
> }
> ```

#### Example Requests

look at __requests__ folder for example requests.

</details>

<br>

<details>
<summary>Update Country</summary>

You can update country with this endpoint.

<br>

#### Parameters

| Parameter    | Is Required | Type   |
|--------------|-------------|--------|
| **name**     | *false*     | string |
| **langCode** | *false*     | string |

Note: you just have to submit the field you want to update. If the name and langCode are not sent at the same time, an error will be returned.

<br>

#### Returns

> is success
>
> ```json
> {
>   "success": true,
>   "message": "Country successfully updated"
> }
> ```

> Not Changed
>
> ```json
> {
>    "success": false,
>    "message": "Change not detected."
> }
> ```

> Authorization Error
>
> ```json
> {
>     "success": false,
>     "message": "You must be logged in to access this page"
> }
> ```

#### Example Requests

look at __requests__ folder for example requests.

</details>

<br>

<details>
<summary>Get Country</summary>

You can get country with this endpoint.

<br>

#### Parameters

| Parameter    | Is Required | Type    |
|--------------|-------------|---------|
| **id**       | *true*      | integer |

<br>

#### Returns

> is success
>
> ```json
> {
>   "success": true,
>   "message": "Country successfully fetched",
>   "data": {
>     "id": 1,
>     "name": "Ukraine",
>     "langCode": "uk-UA"
>   }
> }
> ```

> Validation Error
>
> ```json
> {
>    "success": false,
>    "message": "Validation Error",
>    "data": [
>       {
>          "field": "id",
>          "message": "id field is required"
>       }
>    ]
> }
> ```


#### Example Requests

look at __requests__ folder for example requests.
</details>

<br>

<details>
<summary>GetAll Country</summary>

You can get all countries with this endpoint.

<br>

#### Parameters

| Parameter  | Is Required | Type    | Default |
|------------|-------------|---------|---------|
| **page**   | *false*     | integer | 1       |
| **limit**  | *false*     | integer | 20      |
| **order**  | *false*     | string  | *name*  |
| **sort**   | *false*     | string  | *desc*  |
| **filter** | *false*     | string  | -       |


<br>

#### Returns

> is success
>
> ```json
> {
>   "success": true,
>   "message": "Countries successfully fetched",
>   "data": {
>     "page": 2,
>     "limit": 20,
>     "countries": [
>       {
>         "id": 2,
>         "name": "Ukraine",
>         "langCode": "uk-UA"
>       },
>       {
>         "id": 3,
>         "name": "Turkey",
>         "langCode": "tr-TR"
>       }
>     ]
>   }
> }
> ```


#### Example Requests

look at __requests__ folder for example requests.
</details>

<br>

<details>
<summary>Delete Country</summary>

You can delete country with this endpoint.

<br>

#### Parameters

| Parameter    | Is Required | Type    |
|--------------|-------------|---------|
| **id**       | *true*      | integer |

<br>

#### Returns

> is success
>
> ```json
> {
>   "success": true,
>   "message": "Country successfully deleted"
> }
> ```

> Validation Error
>
> ```json
> {
>    "success": false,
>    "message": "Validation Error",
>    "data": [
>       {
>          "field": "id",
>          "message": "id field is required"
>       }
>    ]
> }
> ```

> Authorization Error
>
> ```json
> {
>     "success": false,
>     "message": "You must be logged in to access this page"
> }
> ```


#### Example Requests

look at __requests__ folder for example requests.

<br>

<hr>

<br>

<summary>Create City</summary>

You can add city with this endpoint.

<br>

#### Parameters

| Parameter     | Is Required | Type   |
|---------------|-------------|--------|
| **name**      | *true*      | string |
| **plateCode** | *true*      | number |
| **countryId** | *true*      | number |

<br>

#### Returns

> is success
>
> ```json
> {
>   "success": true,
>   "message": "City successfully created"
> }
> ```

> Validation Error
>
> ```json
> {
>    "success": false,
>    "message": "Validation Error",
>    "data": [
>       {
>          "field": "name",
>          "message": "name field is required"
>       }
>    ]
> }
> ```

> Authorization Error
>
> ```json
> {
>     "success": false,
>     "message": "You must be logged in to access this page"
> }
> ```

#### Example Requests

look at __requests__ folder for example requests.

</details>

<br>

<details>
<summary>Update City</summary>

You can update city with this endpoint.

<br>

#### Parameters

| Parameter     | Is Required | Type   |
|---------------|-------------|--------|
| **name**      | *false*     | string |
| **plateCode** | *false*     | number |

Note: you just have to submit the field you want to update. If the name and plateCode are not sent at the same time, an error will be returned.

<br>

#### Returns

> is success
>
> ```json
> {
>   "success": true,
>   "message": "City successfully updated"
> }
> ```

> Not Changed
>
> ```json
> {
>    "success": false,
>    "message": "Change not detected."
> }
> ```

> Authorization Error
>
> ```json
> {
>     "success": false,
>     "message": "You must be logged in to access this page"
> }
> ```


#### Example Requests

look at __requests__ folder for example requests.

</details>

<br>

<details>
<summary>Get City</summary>

You can get city with this endpoint.

<br>

#### Parameters

| Parameter    | Is Required | Type    |
|--------------|-------------|---------|
| **id**       | *true*      | integer |

<br>

#### Returns

> is success
>
> ```json
> {
>   "success": true,
>   "message": "City successfully fetched",
>   "data": {
>       "cityId": 1,
>       "cityName": "Istanbul",
>       "countryId": 1,
>       "plateCode": 34,
>       "countryName": "Turkey",
>       "langCode": "tr-TR"
>   }
> }
> ```

> Validation Error
>
> ```json
> {
>    "success": false,
>    "message": "Validation Error",
>    "data": [
>       {
>          "field": "id",
>          "message": "id field is required"
>       }
>    ]
> }
> ```


#### Example Requests

look at __requests__ folder for example requests.
</details>

<br>

<details>
<summary>GetAll Cities</summary>

You can get all cities with this endpoint.

<br>

#### Parameters

| Parameter     | Is Required | Type    | Default |
|---------------|-------------|---------|---------|
| **page**      | *false*     | integer | 1       |
| **limit**     | *false*     | integer | 20      |
| **order**     | *false*     | string  | *name*  |
| **sort**      | *false*     | string  | *desc*  |
| **filter**    | *false*     | string  | -       |
| **countryId** | *false*     | number  | -       |


<br>

#### Returns

> is success
>
> ```json
> {
>   "success": true,
>   "message": "Cities successfully fetched",
>   "data": {
>       "page": 1,
>       "limit": 20,
>       "cities": [
>           {
>               "cityId": 1,
>               "cityName": "İstanbul",
>               "plateCode": 34,
>               "countryId": 1,
>               "countryName": "Turkey",
>               "langCode": "tr-TR"
>           },
>           {
>               "cityId": 2,
>               "cityName": "Ankara",
>               "plateCode": 6,
>               "countryId": 1,
>               "countryName": "Turkey",
>               "langCode": "tr-TR"
>           }
>       ]
> }
> ```


#### Example Requests

look at __requests__ folder for example requests.
</details>

<br>

<details>
<summary>Delete City</summary>

You can delete city with this endpoint.

<br>

#### Parameters

| Parameter    | Is Required | Type    |
|--------------|-------------|---------|
| **id**       | *true*      | integer |

<br>

#### Returns

> is success
>
> ```json
> {
>   "success": true,
>   "message": "City successfully deleted"
> }
> ```

> Validation Error
>
> ```json
> {
>    "success": false,
>    "message": "Validation Error",
>    "data": [
>       {
>          "field": "id",
>          "message": "id field is required"
>       }
>    ]
> }
> ```

> Authorization Error
>
> ```json
> {
>     "success": false,
>     "message": "You must be logged in to access this page"
> }
> ```


#### Example Requests

look at __requests__ folder for example requests.

</details>

<br>

<details>
<summary>Register</summary>

You can get register to this app with this endpoint.

<br>

#### Parameters

| Parameter     | Is Required | Type   | Default                             |
|---------------|-------------|--------|-------------------------------------|
| **email**     | *false*     | string | **info@samisalihibrahimbas.com.tr** |
| **password**  | *false*     | string | **12345**                           |


<br>

#### Returns

> is success
>
> ```json
> {
>   "success": true,
>   "message": "User register successfully"
> }
> ```

> already exists
> 
> 
> ```json
> {
>     "success": false,
>     "message": "User already exists."
> }
> ```

> Validation Error
>
> ```json
> {
>    "success": false,
>    "message": "Validation Error",
>    "data": [
>       {
>          "field": "email",
>          "message": "email field is required"
>       },
>       {
>          "field": "password",
>          "message": "password field is required"
>       }
>    ]
> }
> ```

</details>

<br>

<details>
<summary>Log In</summary>

You can get login to this app with this endpoint.

<br>

#### Parameters

| Parameter     | Is Required | Type   | Default                             |
|---------------|-------------|--------|-------------------------------------|
| **email**     | *false*     | string | **info@samisalihibrahimbas.com.tr** |
| **password**  | *false*     | string | **12345**                           |


<br>

#### Returns


> is success
>
> ```json
> {
>     "success": true,
>     "message": "Successfully logged in",
>     "data": {
>         "email": "info@samisalihibrahimbas.com.tr",
>         "createdAt": "2022-03-27"
>     }
> }
> ```

> not found
>
>
> ```json
> {
>     "success": false,
>     "message": "User not found."
> }
> ```

> Validation Error
>
> ```json
> {
>    "success": false,
>    "message": "Validation Error",
>    "data": [
>       {
>          "field": "email",
>          "message": "email field is required"
>       },
>       {
>          "field": "password",
>          "message": "password field is required"
>       }
>    ]
> }
> ```

</details>

<br>

<details>
<summary>Log Out</summary>

You can get log out from this app with this endpoint.

<br>

#### Returns

> Authorization Error
>
> ```json
> {
>     "success": false,
>     "message": "You must be logged in to access this page"
> }
> ```

> is success
>
> ```json
> {
>     "success": true,
>     "message": "Successfully Signed out"
> }
> ```
</details>