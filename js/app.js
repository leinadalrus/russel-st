import './bootstrap';

/*global console*/
let adminForm = document.querySelector('.custom-form-container')
let emailID = document.getElementById('email-field-style').value
let passwordID = document.getElementById('password-field-style')

let submitSelector = document.querySelector('input[type=button]')
let formData = new FormData(adminForm, submitSelector)

function formatEmailID(emailID) {
  emailID.toUpperCase()

  console.log(
    '%s: previously is now: => %s',
    document.getElementById('patient-id-field'),
    emailID
  )
}

function validateEmailID() {
  let regex = new RegExp('/^(?:[A-Z]{2}[0-9]{1,})$/')
  /// (?:) := Match Everything Enclosed
  /// [A-Z]{2} := Match from A to Z, all upper-case, only of 2 characters limit
  /// [0-9]{1,} := Match from 0 to 9, all upper-case, 1 or more numbers limit

  if (!regex.test(emailID)) {
    formatemailID(emailID)
    console.log('%d: is => %s', emailID, emailID.value)
  }

  return emailID
}

function checksumMod() {
  let emailID = validateEmailID()
  let regex = /^(?:[\D])$+/g

  let digits = emailID.innerText.toString()
  let id = digits.replace(regex, '')

  let sum = (input) => {
    return input.match(id).reduce((head, tail) => {
      return head + tail
    })
  }

  emailID.innerText += String.fromCharCode(Number(sum) + 64)
  console.log('%d: is => %s', emailID, emailID.value)
} // Attribution:
// Sum all kind of number resulting from regular expression, https://stackoverflow.com/a/36097167.

function validateFormData() {
  checksumMod()

  for (let [key, value] of formData.entries()) {
    console.table(`${key}:= ${value}`)
  }

  if (!formData.entries()) sentinelEmitsErrors()
  sentinelSupressesErrors()

  adminForm.addEventListener('submit', (event) => {
    event.preventDefault()
  })
}

function processFormData() {
  window.addEventListener('load', () => {
    validateFormData()

    let request = new XMLHttpRequest()
    let localhost = window.location.protocol + '//' + window.location.host

    let adminData = formData.forEach((key, val) => {
      adminForm[key] = val
    })

    let jsonFileContents = JSON.stringify(adminData)

    for (let [key, value] of formData.entries()) {
      formData[key] = value
      console.table(`${key}:= ${value}`)
    }

    request.open('POST', localhost + '/php/action.php')
    request.setRequestHeader('Content-Type', `application/json`)
    request.send(jsonFileContents)
  })
}

function sentinelEmitsErrors() {
  let suppressionData = formData.forEach(() => {
    adminForm.style.display = 'inline'
  })

  let suppressEmitter = JSON.stringify(suppressionData)
  adminForm.addEventListener('submit', (event) => {
    adminForm.select()
    adminForm.focus()
    event.send(suppressEmitter)
  })
}
