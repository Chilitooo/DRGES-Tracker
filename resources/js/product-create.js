const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

window.createProduct = async function(payload = null) {
  const body = payload ?? {
    sku: 'SKU001',
    name: 'Example Product',
    category: 'General',
    unit: 'pcs',
    selling_price: 9.99,
    safety_stock: 10
  };

  if (!token) {
    console.error('CSRF token not found on page');
    return;
  }

  try {
    const res = await fetch('/products', {
      method: 'POST',
      credentials: 'same-origin',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
      },
      body: JSON.stringify(body)
    });
    const data = await res.json();
    console.log('status:', res.status, data);
  } catch (err) {
    console.error(err);
  }
};