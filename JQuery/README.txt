1. This is defining the grid container for the page. It's creating 5
columns for the page and giving each a size of 1fr. 

2. The header and footer both use grid-column: 1 / span 5; which just 
means start at column 1 or at the left and span 5 columns. That's why 
the header and footer span the entire page horizontally. The main and
aside have spans of 3 and 2 respectively which is why they only take
up smaller portions of the total width. 

3. function finalMessage() {
  // Move the box across the screen
  $(".box").animate({ left: "75%" }, 2000, function () {
    // Callback: Show the message and fade it in
    $(".message")
      .fadeIn(1000)
      .delay(1000) // Wait for 2 seconds
      .fadeOut(1000) // Fade out the message
      .delay(1000)
      .fadeIn(1000);
  });
}

I'm chaining the fading in and out of the next, I'm doing a callback 
once the box finishes moving to display the message.