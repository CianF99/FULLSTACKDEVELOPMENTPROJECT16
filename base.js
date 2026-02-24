// ===============================
// 🛒 MINI E-COMMERCE CONSOLE APP
// ===============================

console.log("===================================");
console.log("🛍️  Welcome to Creative Store");
console.log("===================================");

// -----------------------------
// 📦 Product JSON Data
// -----------------------------
const products = [
    { id: 1, name: "Gaming Laptop", price: 75000 },
    { id: 2, name: "Wireless Mouse", price: 1200 },
    { id: 3, name: "Smartphone", price: 30000 },
    { id: 4, name: "Mechanical Keyboard", price: 4500 }
];

// -----------------------------
// 🖥️ Display All Products
// -----------------------------
function displayProducts(productList) {
    console.log("\n📋 Product List:");
    productList.forEach(p => {
        console.log(`➡️  ${p.name} | Price: ₹${p.price}`);
    });
}

displayProducts(products);

// -----------------------------
// 🔍 Filter Products by Minimum Price
// -----------------------------
function filterByMinPrice(minPrice) {
    console.log(`\n🔎 Products above ₹${minPrice}:`);

    const filtered = products.filter(p => p.price >= minPrice);

    if (filtered.length === 0) {
        console.log("❌ No products found.");
    } else {
        filtered.forEach(p => {
            console.log(`✅ ${p.name} | ₹${p.price}`);
        });
    }
}

// Simulated User Input
const userMinPrice = 20000;
filterByMinPrice(userMinPrice);

// ===============================
// 🚀 ASYNC E-COMMERCE SIMULATION
// ===============================

// Simulate fetching products
function fetchProducts() {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            resolve(products);
            // To simulate error:
            // reject("Failed to fetch products!");
        }, 2000);
    });
}

// Simulate fetching reviews
function fetchReviews() {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            resolve([
                { productId: 1, review: "🔥 Excellent performance!" },
                { productId: 3, review: "⭐ Worth every rupee!" }
            ]);
            // To simulate error:
            // reject("Failed to fetch reviews!");
        }, 1500);
    });
}

// -----------------------------
// ⏳ Load Data in Parallel
// -----------------------------
async function loadStoreData() {
    console.log("\n⏳ Loading store data...");

    try {
        const [productData, reviewData] = await Promise.all([
            fetchProducts(),
            fetchReviews()
        ]);

        console.log("\n✅ Products Loaded Successfully!");
        console.log("📦 Products:", productData);

        console.log("\n💬 Reviews Loaded Successfully!");
        console.log("📝 Reviews:", reviewData);

    } catch (error) {
        console.error("\n❌ Error Occurred:", error);
    }
}

// Execute Async Function
loadStoreData();