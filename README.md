# restfulci
Restful boilerplate for CodeIgniter3 which provides an easy integration and fast creation of an API with less code and more adaptive resources

### How to use?
Download/clone the repository and move it to apache server. (Make sure .htacess can write)
After that simply check out the example controller and the main helper.


### Main type resolving
This feature means that the response methods automaticly care for data conversion to specific formats and prevents wrong formats/errors leak going further
For example, if you have a php array and want it to be a XML or JSON you can specify the format to the method and it will automaticly take care of it.

#### Creating a new controller
```php
<?php
    class YourController extends REST_Controller
    {
        function __construct()
        {
            parent::__construct(); //make sure you call
        }
    }

>
```

#### Rendering information/Giving the response

```php
<?php
    class YourController extends REST_Controller
    {
        function __construct()
        {
            parent::__construct(); //make sure you call
        }

        function index()
        {
            /**
             * This is pretty simple, we accept 3 given format which are the main:
             *  - application/json
             *  - application/xml
             *  - text
             * Format is optional but if you want 
             * to convert your data like from JSON to *XML or etc you can do it by *specific the desired format. By * default it will check the object type
             * 
             * Http Status Code : 200
             **/
            Ok(object, format);

            /**
             * This one does not accept formats and just format according to the given type
             * 
             * Http Status Code: 500
             **/
            InternalServerError(error)

            /**
             * Used to prevent access to the page
             * 
             * Http Status Code: 403
             **/
            Forbidden(msg)

            /**
             * More verboses to come soon
             * 
             */
        }
    }
>
```

#### Support
I will be contributing to this boilerplate in order to show the power of CodeIgniter with an optmized performance in microservices/apis itself.
You are free to contribute, also if you have any idea of feature to implement, feel free to ask