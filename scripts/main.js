'use strict'
document.addEventListener('DOMContentLoaded', e => {
    let date = new Date()
    const year = date.getFullYear()
    let yearContent = document.querySelector('#year')
    yearContent.innerHTML = year

    // Change the typed value of the first letter to uppercase for input fields and lowercase for email fields
    document.querySelector('#firstName').onchange = e => {
        let val = document.querySelector('#firstName').value
        RegExp = /\b[a-z]/g

        val = val.charAt(0).toUpperCase() + val.substr(1)
    }

    document.querySelector('#middleName').onchange = e => {
        let val = document.querySelector('#middleName').value
        RegExp = /\b[a-z]/g

        val = val.charAt(0).toUpperCase() + val.substr(1)
    }

    document.querySelector('#lastName').onchange = e => {
        let val = document.querySelector('#lastName').value
        RegExp = /\b[a-z]/g

        val = val.charAt(0).toUpperCase() + val.substr(1)
    }

    document.querySelector('#email').onchange = e => {
        let val = document.querySelector('#email').value
        RegExp = /\b[a-z]/g

        val = val.toLowerCase()
    }

    document.querySelector('#reasonForVolunteering').onchange = e => {
        let val = document.querySelector('#reasonForVolunteering').value
        RegExp = /\b[a-z]/g

        val = val.charAt(0).toUpperCase() + val.substr(1)
    }

    document.querySelector('#communicationChannel').onchange = e => {
        let val = document.querySelector('#communicationChannel').value
        RegExp = /\b[a-z]/g

        val = val.charAt(0).toUpperCase() + val.substr(1)
    }

    const form = document.querySelector('form')
    // On Form Submit
    form.addEventListener('submit', e => {
        let forms = document.getElementsByClassName('needs-validation')
        // Check to see if form has validation errors
        let validation = Array.prototype.filter.call(forms, (form) => {
            if (form.checkValidity() === false) {
                e.preventDefault()
                e.stopPropagation()
            }
            form.classList.add('was-validated')
        })


        // If form doesn't have validation errors
        if (form.checkValidity() === true) {
            e.preventDefault()

            // change the button color and add the loading class
            document.querySelector('button').classList.remove('btn-danger')
            document.querySelector('button').classList.add('btn-primary')
            document.querySelector('button').innerHTML =
                'Loading <span class="spinner"></span><i class="fa fa-spinner fa-spin"></i></span>'
        }
    })
})

