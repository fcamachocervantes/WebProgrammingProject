1. Using $_SERVER["PHP_SELF"] can let a malicious user inject a script
    into the url which will then be interpreted and placed into the html
    document and have the injected script ran. To avoid an injection of a
    script or other malicious code we should use
    htmlspecialchars($_SERVER["PHP_SELF"]) which will prevent the script
    injection from being interpreted as code.

2. Server validation is important for security purposes and preventing a
    malicious user from being able to exploit your web page and attack your
    systems or other users who could unknowingly load a malicious script a 
    malicious user could have embedded into something like their profile page.
    Client side validation is important because it makes sure that average users
    have a good experience with the webpage and are able to interact in a way that
    the developer expected. Combining both is important to give users the best
    experience when using your webpage while simultaneously protecting against
    attackers.