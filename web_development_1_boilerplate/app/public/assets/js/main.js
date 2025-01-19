console.log("hello from js!");

function validateAddCarForm() {
    const carName = document.getElementById('carName').value;
    const carPrice = document.getElementById('carPrice').value;
    const carImage = document.getElementById('carImage').value;

    if (carName === '' || carPrice === '' || carImage === '') {
        alert('All fields are required.');
        return false;
    }

    if (isNaN(carPrice) || carPrice <= 0) {
        alert('Please enter a valid price.');
        return false;
    }

    return true;
}

function addCar() {
    if (!validateAddCarForm()) {
        return;
    }

    var formData = new FormData(document.getElementById('addCarForm'));

    fetch('/ajax/add_car', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            alert('Car added successfully.');
            location.reload(); 
        } else {
            alert('An error occurred while adding the car.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while adding the car.');
    });
}

document.getElementById('addCarForm').addEventListener('submit', function (e) {
    e.preventDefault();
    addCar();
});