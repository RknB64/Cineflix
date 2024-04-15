$(function() {
  // Function to perform live search as the user types
  $('#search-box input[name="ville"]').keyup(function() {
      var keyword = $(this).val(); // Get the entered keyword
      // AJAX call to send request to the server to fetch cities
      $.ajax({
          url: './controleur/searchController.php', // URL of your PHP controller
          type: 'GET',
          data: { ville: keyword }, // Send the keyword as data
          success: function(response) {
              // Parse the response data as JSON
              var cities = JSON.parse(response);
              // Update autocomplete source with the fetched cities
              $('#search-box input[name="ville"]').autocomplete({
                  source: cities, // Use the fetched cities as autocomplete source
                  minLength: 2
              });

              // AJAX call to fetch cinema data for the selected city
              $.ajax({
                  url: './controleur/searchController.php', // URL of your PHP controller
                  type: 'GET',
                  data: { city: keyword }, // Send the city as data
                  success: function(cinemaResponse) {
                      // Parse the response data as JSON
                      var cinemas = JSON.parse(cinemaResponse);
                      // Display cinemas in some element on the page
                      $('#cinema-list').empty(); // Clear existing cinemas
                      $.each(cinemas, function(index, cinema) {
                          $('#cinema-list').append('<p>' + cinema + '</p>');
                      });
                  },
                  error: function(xhr, status, error) {
                      console.error('Error fetching cinema data:', error);
                  }
              });
          },
          error: function(xhr, status, error) {
              console.error('Error fetching cities:', error);
          }
      });
  });
});
