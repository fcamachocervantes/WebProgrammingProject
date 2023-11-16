1. Instead of the form doing the POST request this is done by the
    JS code when it does the ajax request.

2. ajaxsubmit.php is executed if the form is filled out correclty.

3. The data is collected using the ids of the fields and then sent
    with the post request by appending them to the header of the post
    request.

4. The callback function is just doing an alert of the json object that's
    returned by the php.

5. In the PHP file the query to the db is automatically formatting a 
    response to the HTTP request that the PHP is handleing. I'm not 
    entirely sure how it's done in the example but in my PHP code the 
    echo of the result form the SQL query is what correctly returns a
    response to the HTTP request made. 