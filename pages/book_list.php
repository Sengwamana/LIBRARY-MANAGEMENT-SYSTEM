<?php
require_once '../middleware/auth_middleware.php';
checkAuth();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books - Library Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/book_list.css">
    <style>
        /* Global Styles */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f6f9;
    color: #333;
    line-height: 1.6;
    min-height: 100vh;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 40px auto;
    padding: 20px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    font-size: 2.2rem;
    color: #007bff;
    text-align: center;
    margin-bottom: 30px;
}

/* Search Bar Styles */
.search-bar {
    display: flex;
    justify-content: center;
    position: relative;
    margin-bottom: 30px;
}

.search-bar input {
    width: 100%;
    max-width: 500px;
    padding: 12px 15px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 30px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 10px rgba(0, 123, 255, 0.1);
}

.search-bar input:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.2);
}

.search-icon {
    position: absolute;
    right: 25px;
    top: 50%;
    transform: translateY(-50%);
    color: #007bff;
    font-size: 1.2rem;
}

/* Loading Spinner */
.spinner {
    text-align: center;
    margin-bottom: 20px;
    color: #007bff;
    font-size: 1.2rem;
}

/* Book List */
ul#book-list {
    list-style: none;
    padding: 0;
}

ul#book-list li {
    background-color: #f9f9f9;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

ul#book-list li:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.1);
}

ul#book-list li strong {
    color: #007bff;
    font-size: 1.1rem;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .container {
        width: 95%;
    }

    h2 {
        font-size: 1.8rem;
    }

    .search-bar input {
        font-size: 0.9rem;
        padding: 10px 12px;
    }

    .search-icon {
        font-size: 1rem;
    }

    ul#book-list li {
        font-size: 0.9rem;
    }
}

    </style>
    <script src="../assets/js/main.js"></script>
</head>
<body>
    <?php include '../components/header.php'; ?>

    <div class="container">
        <h2>Book List</h2>
        <div class="search-bar">
            <input type="text" id="search" placeholder="Search books..." aria-label="Search books">
            <i class="fas fa-search search-icon"></i>
        </div>

        <!-- Loading spinner -->
        <div id="loading" class="spinner" style="display: none;">
            <i class="fas fa-spinner fa-spin"></i> Loading...
        </div>
        
        <ul id="book-list" aria-live="polite"></ul>
    </div>

    <script>
        let timeout = null;

        document.getElementById('search').addEventListener('input', function() {
            clearTimeout(timeout);
            const query = this.value;

            timeout = setTimeout(() => {
                const bookList = document.getElementById('book-list');
                const loading = document.getElementById('loading');

                // Show loading indicator
                loading.style.display = 'block';

                fetch(`../api/book_api.php?search=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        bookList.innerHTML = '';

                        // Hide loading indicator
                        loading.style.display = 'none';

                        if (data.length === 0) {
                            bookList.innerHTML = '<li>No books found</li>';
                        } else {
                            data.forEach(book => {
                                const listItem = document.createElement('li');
                                listItem.innerHTML = `<strong>${book.title}</strong> by ${book.author}`;
                                bookList.appendChild(listItem);
                            });
                        }
                    })
                    .catch(error => {
                        bookList.innerHTML = '<li>Failed to load books. Please try again later.</li>';
                        console.error('Error fetching books:', error);

                        // Hide loading indicator
                        loading.style.display = 'none';
                    });
            }, 300); // 300ms debounce time
        });
    </script>

    <?php include '../components/footer.php'; ?>
</body>
</html>
