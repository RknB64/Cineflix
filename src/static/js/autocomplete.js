var search_terms = ['vannes', 'rennes', 'auray', 'lorient' ];

function autocompleteMatch(input) {
    if (input == '') {
        return [];
    }
    var reg = new RegExp(input);
    return search_terms.filter(function(term) {
        if (term.match(reg)) {
            return term;
        }
    });
}

function showResults(val) {
    var res = document.getElementById("search-results");
    res.innerHTML = '';
    var list = '';
    var terms = autocompleteMatch(val);
    for (var i = 0; i < terms.length; i++) {
        list += '<li onclick="populateSearchBox(this)" ondblclick="changeSearch(this)" class="search-item">' + terms[i] + '</li>';
    }
    res.innerHTML = '<ul>' + list + '</ul>';
}

// Function to populate the search box with the clicked term
function populateSearchBox(item) {
    var searchBox = document.getElementById("search-box").querySelector("input[type='text']");
    searchBox.value = item.textContent;
    
    // Remove 'selected' class from previously selected item
    var previouslySelected = document.querySelector('.search-results li.selected');
    if (previouslySelected) {
        previouslySelected.classList.remove('selected');
    }
    
    // Add 'selected' class to the clicked item
    item.classList.add('selected');
}

// Function to change the search when an item is double-clicked
function changeSearch(item) {
    var searchBox = document.getElementById("search-box").querySelector("input[type='text']");
    searchBox.value = item.textContent;
    document.getElementById("search-box").submit();
  
}
