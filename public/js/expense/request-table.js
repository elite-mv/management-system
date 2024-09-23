const downloadExpenseForm = document.querySelector('#downloadExpenseForm');
const downloadExpenseInput = document.querySelector('#downloadExpenseInput');

const downloadCheckForm = document.querySelector('#downloadCheckForm');
const downloadCheckInput = document.querySelector('#downloadCheckInput');

const auditItemForm = document.querySelector('#auditItemForm');
const auditItemInput = document.querySelector('#auditItemInput');

const filterModal = new bootstrap.Modal('#filterModal');
const checkedInputs = new Map();

const collapseLayout = document.querySelector('#collapseLayout');
const requestData = document.querySelector('#requestData');
const filterForm = document.querySelector('#filterForm');
const inputs = document.querySelectorAll('.inputs');

let requestAllInput = document.querySelector('#requestAllInput');
let requestAllItemInput = document.querySelectorAll('.request-input-selection');

let requestInputSelections = [];

inputs.forEach(input => {
    input.addEventListener('change', () => {
        filterForm.submit();
    })
});

requestAllInput.addEventListener('input', () => {
    requestAllItemInput.forEach(item => {

        item.checked = requestAllInput.checked;

        const id = item.dataset.id;

        //load keys from local storage
        let prevData = JSON.parse(window.localStorage.getItem('checkedInputs'));

        if (prevData) {
            prevData.forEach(key => {
                checkedInputs.set(key, key)
            });
        }

        if (item.checked) {
            checkedInputs.set(id, id)
        } else {
            checkedInputs.delete(id)
        }

        const data = [...checkedInputs.keys()];

        const mapString = JSON.stringify(data);

        localStorage.setItem('checkedInputs', mapString);

    });

    fireEvent();
});

requestAllItemInput.forEach(item => {

    item.addEventListener('input', (e) => {

        const checkbox = e.target;
        const id = item.dataset.id;

        //load keys from local storage
        let prevData = JSON.parse(window.localStorage.getItem('checkedInputs'));

        if (prevData) {
            prevData.forEach(key => {
                checkedInputs.set(key, key)
            });
        }

        if (checkbox.checked) {
            checkedInputs.set(id, id)
        } else {
            checkedInputs.delete(id)
        }

        const data = [...checkedInputs.keys()];

        const mapString = JSON.stringify(data);

        localStorage.setItem('checkedInputs', mapString);

        fireEvent();
    })
});


window.addEventListener('load', () => {

    let prevData = JSON.parse(window.localStorage.getItem('checkedInputs'));

    if (prevData) {
        prevData.forEach(key => {

            const checkbox = document.querySelector(`#requestInput${key}`);

            // null check
            if (!checkbox) {
                return
            }

            checkbox.checked = true;

        });
    }

    fireEvent();
});

function fireEvent() {

    const data = JSON.parse(localStorage.getItem('checkedInputs'));

    if (data && data.length) {
        collapseLayout.classList.remove('d-none');
    } else {
        collapseLayout.classList.add('d-none');
    }

}

if (downloadExpenseForm) {
    downloadExpenseForm.addEventListener('submit', (e) => {
        e.preventDefault();

        downloadExpenseInput.value = JSON.parse(localStorage.getItem('checkedInputs'));

        downloadExpenseForm.submit();
    })
}

if (downloadCheckForm) {

    downloadCheckForm.addEventListener('submit', (e) => {
        e.preventDefault();

        downloadCheckInput.value = JSON.parse(localStorage.getItem('checkedInputs'));

        downloadCheckForm.submit();
    })
}

if (auditItemForm) {

    auditItemForm.addEventListener('submit', (e) => {
        e.preventDefault();

        auditItemInput.value = JSON.parse(localStorage.getItem('checkedInputs'));

        auditItemForm.submit();
    })
}

window.addEventListener('storage', function (event) {
    if (filterForm && event.key === 'update') {
        setTimeout(() => {
            filterForm.submit();
        }, 500)
    }
})

const bulkUpdate = document.querySelector('#bulkUpdate');

function bulkUpdates() {
    bulkUpdate.classList.toggle('d-none')
}
