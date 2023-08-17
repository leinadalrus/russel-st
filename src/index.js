/*global console*/
'use strict'

function formatPatientID(patientID) {
  if (patientID.oninput) {
    patientID.innerHTML.toUpperCase()
  }
}

function validatePatientID() {
  let patientID = document.getElementById('patient-id-field')
  let regex = new RegExp('/^(?:[A-Z]{2}[0-9]{1,})$/')
  /// (?:) := Match Everything Enclosed
  /// [A-Z]{2} := Match from A to Z, all upper-case, only of 2 characters limit
  /// [0-9]{1,} := Match from 0 to 9, all upper-case, 1 or more numbers limit

  if (!regex.test(patientID)) {
    formatPatientID(patientID)
  }

  return patientID
}

function checksumMod() {
  let patientID = validatePatientID()
  let regex = /^(?:[\D])$+/g

  let digits = patientID.innerText.toString()
  let id = digits.replace(regex, '')

  let sum = input => {
    return input.match(id).reduce((head, tail) => {
      return head + tail
    })
  }

  patientID.innerText += String.fromCharCode(Number(sum) + 64)
} // Attribution:
// Sum all kind of number resulting from regular expression, https://stackoverflow.com/a/36097167.

function processFormData() {
  checksumMod()

  let bookingForm = document.getElementById('booking-form')
  let submitSelector = document.querySelector('input[type=button]')

  let formData = new FormData(bookingForm, submitSelector)

  let data = formData.forEach((key, val) => {
    bookingForm[key] = val
  })

  let json = JSON.stringify(data)

  bookingForm.addEventListener('submit', event => {
    request.open('POST', '/php/action.php')
    request.send(json)

    event.preventDefault()
  })
}
