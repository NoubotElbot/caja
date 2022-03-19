document.addEventListener('DOMContentLoaded', () => {
    const add_productos = document.getElementsByClassName('add-product-btn');
    const sub_productos = document.getElementsByClassName('sub-product-btn');
    const save_btn = document.getElementById('save-btn');


    const getTotal = () => {
        let total = 0;
        venta.forEach(function myFunction(item, index, arr) {
            total += item.price * item.product_count;
        });
        return formatter.format(total);;
    }

    const formatter = new Intl.NumberFormat('de-DE');

    const countProduct = (id, sub = false) => {
        venta.forEach(function myFunction(item, index, arr) {
            if (item.product_id === id) {
                if (sub) {
                    if (item.product_count) item.product_count--
                    if (item.product_count === 0) document.getElementById(`${id}-sub`).classList.add('d-none');
                } else {
                    item.product_count++
                    document.getElementById(`${id}-sub`).classList.remove('d-none');
                }
                document.getElementById(`${id}-count`).textContent = 'x' + item.product_count;
            }
        });
        document.getElementById('total').textContent = 'Total: $' + getTotal();
    }



    let venta = [];
    let productos = [];
    axios.get('/productos').then(function (response) {
        productos = response.data;
        for (const element of add_productos) {
            let id = element.getAttribute('product');
            venta.push({
                product_id: id,
                price: productos.find(producto => producto.id == id).price,
                product_count: 0
            });
            element.addEventListener('click', (e) => {
                countProduct(id)
            });
        }
        console.log(venta);

        for (const element of sub_productos) {
            let id = element.getAttribute('product');
            element.addEventListener('click', (e) => {
                countProduct(id, true)
            });
        }
        save_btn.removeAttribute('disabled');

        save_btn.addEventListener('click', (e) => {
            axios.post('/ventas', { venta }).then(function (response) {
                window.location.reload(true);
            });
        });
    });
});


