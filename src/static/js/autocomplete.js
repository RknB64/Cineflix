
$(function() {
    // Initialize autocomplete
    $('#search-box input[name="ville"]').autocomplete({
      source: '../autocomplete.php', // URL pour fetch autocomplete suggestions
      minLength: 1 // Minimum characters avant triggering autocomplete
    });
  });