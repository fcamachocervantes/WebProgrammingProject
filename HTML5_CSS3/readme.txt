1. With your screen wide enough so all menu items are displayed,
    what happens if you comment out float: left for the topnav anchors?
    
        Each menu item becomes the same width as the screen and are each put on 
        their own row.

2.  Continuing, what happens if you coment out both float: left and
    display: block?

        The menu items only have the height of their text and the padding on
        the left and right becomes significantly smaller, just about enough
        for the text for each menu item. The topnav is also very skinny
        and the menu items are again on the same row.

3. Shrink the width of your page. Why is the hamburger icon only displayed
    when the screen is small? (i.e., explain what lines of CSS do this...
    cut-and-paste lines of code as needed)

        This code is responsible for changing the top nav bar when the screen
        size changes

        @media screen and (max-width: 600px) {
            .topnav a:not(:first-child) {display: none;}
            .topnav a.icon {
                float: right;
                display: block;
            }
        }

4. Why does only the Home menu option display when the screen is small?
    (again, the CSS code)

        .topnav a:not(:first-child) {display: none;}

        This line in the above code block ensures that everything but the first child
        isn't visible.

5. Although we haven't yet studied JavaScript, take a look at the JS code
    and try to explain what that code is doing. Do NOT just copy the comment
    line... be more specific.

        The JavaScript is observing the hamburger menu and checking on if it's been
        clicked yet. If it's been clicked then the top nav menu is updated to show
        the other menu buttons. If it has been clicked and the other menu items
        are already visible then the top nav
        is updated to hide the other menu items. This is being done by 
        updating the name of the class for the topNav and then the CSS has 
        two cases for different styling based on the class name for the top nav.
        