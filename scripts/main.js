'use strict'
document.addEventListener('DOMContentLoaded', e => {
    let date = new Date()
    const year = date.getFullYear()
    let yearContent = document.querySelector('#year')
    yearContent.innerHTML = year
    window.addEventListene(
        'load')
    $(document).ready(() => {
        // DOM is fully loaded
        // Capitalize the first letter of First Name
        $('#firstName').on('change', function (e) {
            let $this = $(this),
                val = $this.val()
            RegExp = /\b[a-z]/g

            val = val.charAt(0).toUpperCase() + val.substr(1)
        })
        $(document).ready(() => {
            // DOM is fully loaded
            // Capitalize the first letter of Middle Name
            $('#middleName').on('change', function (e) {
                let $this = $(this),
                    val = $this.val()
                RegExp = /\b[a-z]/g

                val = val.charAt(0).toUpperCase() + val.substr(1)
            })
            $(document).ready(() => {
                // DOM is fully loaded
                // Capitalize the first letter of Last Name
                $('#lastName').on('change', function (e) {
                    let $this = $(this),
                        val = $this.val()
                    RegExp = /\b[a-z]/g

                    val = val.charAt(0).toUpperCase() + val.substr(1)
                })
                // change the email to lowercase
                $('#email').on('change', function (e) {
                    let $this = $(this),
                        val = $this.val()
                    val = val.toLowerCase()
                })


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
    })
})
})

