document.addEventListener('DOMContentLoaded', function () {
    // Fetch products from the server
    fetch('products.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Products data:', data); // Debugging: Log the fetched data
            const productsContainer = document.getElementById('products');
            if (!productsContainer) {
                console.error('Products container not found!');
                return;
            }
            // Loop through each product and create a product card
            data.forEach(product => {
                const productDiv = document.createElement('div');
                productDiv.className = 'product';
                productDiv.innerHTML = `
    <img src="images/${product.image_url}" alt="${product.name}">
    <h3>${product.name}</h3>
    <p>${product.description}</p>
    <p>$${product.price}</p>
    <p>Category: ${product.category}</p>
    <button onclick="addToCart(${product.id})">Add to Cart</button>
    <div class="reviews">
        <h4>Reviews</h4>
        ${product.reviews.map(review => `
            <div class="review">
                <p>${review.comment}</p>
                <p>Rating: ${review.rating}/5</p>
            </div>
        `).join('')}
        <form onsubmit="submitReview(event, ${product.id})">
            <input type="number" name="rating" min="1" max="5" placeholder="Rating" required>
            <textarea name="comment" placeholder="Your review" required></textarea>
            <button type="submit">Submit Review</button>
        </form>
    </div>
`;
                productsContainer.appendChild(productDiv);
            });
        })
        .catch(error => console.error('Error fetching products:', error));
});

let cart = [];

function addToCart(productId) {
    // Find the product in the fetched data
    fetch('products.php')
        .then(response => response.json())
        .then(data => {
            const product = data.find(p => p.id === productId);
            if (product) {
                cart.push(product);
                alert(`${product.name} added to cart!`);
                updateCartDisplay();
            }
        });
}

function updateCartDisplay() {
    const cartContainer = document.getElementById('cart');
    if (cartContainer) {
        cartContainer.innerHTML = '<h2>Cart</h2>';
        cart.forEach(item => {
            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';
            cartItem.innerHTML = `
                <p>${item.name} - $${item.price}</p>
            `;
            cartContainer.appendChild(cartItem);
        });
    }
}