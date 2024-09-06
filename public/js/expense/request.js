const uploadImageInput = document.querySelector('#requestItemImageInput');

const requestForm = document.querySelector('#requestForm');
const requestPriorityLevel = document.querySelector('#requestPriorityLevel');
const requestPriority = document.querySelector('#requestPriority');
const itemTotal = document.querySelector('#itemTotal');


const requestItemId = document.querySelector('#requestId');
const requestItemQuantity = document.querySelector('#requestQuantity');
const requestItemUnitOfMeasure = document.querySelector('#requestUnitOfMeasure');
const requestItemJobOrder = document.querySelector('#requestJobOrder');
const requestItemDescription = document.querySelector('#requestDescription');
const requestItemUnitCost = document.querySelector('#requestUnitCost');
const requestItemTotal = document.querySelector('#requestTotal');

const requestItemAttachment = document.querySelector('#itemAttachment');
const requestItemAttachmentPreview = document.querySelector('#itemAttachmentPreview');

let selectedIndex = null;

window.addEventListener("load", ()=>{
    viewCart();
    calculateTotal();
});


const formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'PHP',
  });

requestItemQuantity.addEventListener('change',calculateSubtotal)
requestItemUnitCost.addEventListener('change',calculateSubtotal)

requestForm.addEventListener('submit',(e)=>{

    e.preventDefault();

    const requestCompany =  document.querySelector('input[name="company"]:checked');

    if(!requestCompany){
        Swal.fire({
            icon: "warning",
            title: "Oops...",
            text: "Please select a company first",
        });

        return;
    }

    requestForm.submit();
})

function calculateSubtotal(){
    let total =   Number(requestItemQuantity.value) *  Number(requestItemUnitCost.value);
    requestItemTotal.value = formatter.format(total);
}

// Called when an expense request is click
async function onSelectExpenseRequest(requestId) {

    try {

        unselectRow(selectedIndex);
        selectedIndex = requestId;
        selectRow(selectedIndex);

        let result = await fetch(`/expense/api/request-item/${requestId}`, {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        })

        if (!result.ok) {

            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "An error occurred while fetching selected item",
            });

            unselectRow(selectedIndex);
            selectedIndex = null;
            return;
        }

        let data = await result.json();

        requestItemId.value = data.id;
        requestItemUnitOfMeasure.value = data.measurement_id;
        requestItemJobOrder.value = data.job_order_id;
        requestItemQuantity.value = data.quantity;
        requestItemDescription.value = data.description;
        requestItemUnitCost.value = data.cost;
        requestItemTotal.value = formatter.format(data.total);


    } catch (error) {
        console.error(error.message);
    }
}

function selectRow(id) {

    const row = document.querySelector(`#requestItem${id}`);

    if (!row) {
        console.warn('Selecting a null index row');
        return;
    }

    row.classList
        .add('bg-secondary', 'text-white');

    requestItemAttachment
        .classList
        .remove('d-none');

    requestItemAttachmentPreview
        .classList
        .remove('d-none');

}

function unselectRow(id) {

    const row = document.querySelector(`#requestItem${id}`);

    if (!row) {
        console.warn('Unselecting a null index row');
        return;
    }

    row.classList
        .remove('bg-secondary', 'text-white');

    requestItemAttachment
        .classList
        .add('d-none');

    requestItemAttachmentPreview
        .classList
        .add('d-none');
}

function unselectItem() {
    requestItemId.value = null; // Setting requestItemId to null
    requestItemUnitOfMeasure.value = null; // Setting Unit of Measure to null
    requestItemJobOrder.value = null; // Setting Job Order to null
    requestItemQuantity.value = null; // Setting Quantity to null
    requestItemDescription.value = null; // Setting Description to null
    requestItemUnitCost.value = null; // Setting Unit Cost to null
    requestItemTotal.value = null; // Setting Total to null

    unselectRow(selectedIndex)
    selectedIndex = null;
}

async function deleteItem() {

    try {
        let result = await fetch(`/expense/api/request-item/${selectedIndex}`, {
            method: 'DELETE',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        })

        if (!result.ok) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "An error occurred while fetching selected item",
            });
        }

        unselectItem();
        selectedIndex = null;
        viewCart();
        calculateTotal();


    } catch (error) {
        console.error(error.message);
    }
}

async function updateItem() {

    try {
        let formData = new FormData();

        formData.append('quantity', requestItemQuantity.value);
        formData.append('measurement', requestItemUnitOfMeasure.value);
        formData.append('jobOrder', requestItemJobOrder.value);
        formData.append('description', requestItemDescription.value);
        formData.append('cost', requestItemUnitCost.value);

        let result = await fetch(`/expense/api/request-item/${selectedIndex}`, {
            method: 'POST',
            body: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        })

        if (!result.ok) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "An error occurred while updating a request item",
            });

            return;
        }

        await viewCart();
        selectRow(selectedIndex);
        calculateTotal();

        speek('Item has been updated!');

    } catch (error) {
        console.error(error.message);
    }
}

async function addItem() {

    try {

        if (selectedIndex) {
            throw Error('Cannot add item, please unselect the item first');
        }

        let formData = new FormData();

        formData.append('quantity', requestItemQuantity.value);
        formData.append('measurement', requestItemUnitOfMeasure.value);
        formData.append('jobOrder', requestItemJobOrder.value);
        formData.append('description', requestItemDescription.value);
        formData.append('cost', requestItemUnitCost.value);

        let result = await fetch(`/expense/api/request-item`, {
            method: 'POST',
            body: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        })

        if (!result.ok) {
            throw Error('An error occurred while updating a request item')
        }

        await viewCart();
        unselectItem();
        calculateTotal();

    } catch (error) {
        console.error(error.message);
    }
}

async function viewCart() {
    try {
        let result = await fetch(`/expense/api/request-item`, {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        })

        if (!result.ok) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: 'An error occurred while retrieving items',
            });

            return;
        }

        let data = await result.text();

        $('#request_cart > tbody').html(data);

    } catch (error) {
        console.error(error.message);
    }
}

async function calculateTotal() {

    try {
        let result = await fetch(`/expense/api/request-item/total`, {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        })

        if (!result.ok) {
            throw Error('An error occurred while getting total')
        }

        let data = await result.json();

        itemTotal.value = formatter.format(data.total);

    } catch (error) {
        console.error(error.message);
    }
}

uploadImageInput.addEventListener('change', async () => {

    let formData = new FormData();

    const files = uploadImageInput.files;

    Array.from(files).forEach(file => {
        formData.append('files[]', file);
    });


    try {

        let result = await fetch(`/expense/api/request-item/file/${selectedIndex}`, {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        })

        if (!result.ok) {

            let data = await result.json();

            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: 'An error occurred while uploading attachment',
            });

            console.log(data);

            return;
        }

        let files = await result.json();

        files.images.forEach(src => {

            let imageSrc = (src.split('/'))[1];

            const thumbnail = $('<div>').append($('<img>').attr('src', '/storage/' + imageSrc).addClass('uploaded-img imageModal'));
            $('#image_container').append(thumbnail);
        });

        reloadImageModal();
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: error.message,
        })

    } finally {
        uploadImageInput.value = null;
    }
})
