/*global console*/
let bookingForm = document.querySelector('#booking-form')
let patientID = document.getElementById('patient-id-field').value
let bookingDateID = document.getElementById('booking-date-field')

let submitSelector = document.querySelector('input[type=button]')
let formData = new FormData(bookingForm, submitSelector)

function mitigatePastDates() {
  let date = new Date()

  let restrictorValue = date.toISOString().slice(0, 10)
  let bookingDateAttr = bookingDateID.getAttribute('min')

  console.table([date, restrictorValue, bookingDateID])

  bookingDateID.setAttribute(bookingDateAttr, restrictorValue)
}

function formatPatientID(patientID) {
  patientID.toUpperCase()

  console.log(
    '%s: previously is now: => %s',
    document.getElementById('patient-id-field'),
    patientID
  )
}

function validatePatientID() {
  let regex = new RegExp('/^(?:[A-Z]{2}[0-9]{1,})$/')
  /// (?:) := Match Everything Enclosed
  /// [A-Z]{2} := Match from A to Z, all upper-case, only of 2 characters limit
  /// [0-9]{1,} := Match from 0 to 9, all upper-case, 1 or more numbers limit

  if (!regex.test(patientID)) {
    formatPatientID(patientID)
    console.log('%d: is => %s', patientID, patientID.value)
  }

  return patientID
}

function checksumMod() {
  let patientID = validatePatientID()
  let regex = /^(?:[\D])$+/g

  let digits = patientID.innerText.toString()
  let id = digits.replace(regex, '')

  let sum = (input) => {
    return input.match(id).reduce((head, tail) => {
      return head + tail
    })
  }

  patientID.innerText += String.fromCharCode(Number(sum) + 64)
  console.log('%d: is => %s', patientID, patientID.value)
} // Attribution:
// Sum all kind of number resulting from regular expression, https://stackoverflow.com/a/36097167.

function validateFormData() {
  checksumMod()

  for (let [key, value] of formData.entries()) {
    console.table(`${key}:= ${value}`)
  }

  if (!formData.entries()) sentinelEmitsErrors()
  sentinelSupressesErrors()

  bookingForm.addEventListener('submit', (event) => {
    event.preventDefault()
  })
}

function processFormData() {
  window.addEventListener('load', () => {
    validateFormData()

    let request = new XMLHttpRequest()
    let localhost = window.location.protocol + '//' + window.location.host

    let bookingData = formData.forEach((key, val) => {
      bookingForm[key] = val
    })

    let jsonFileContents = JSON.stringify(bookingData)

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
    bookingForm.style.display = 'inline'
  })

  let suppressEmitter = JSON.stringify(suppressionData)
  bookingForm.addEventListener('submit', (event) => {
    bookingForm.select()
    bookingForm.focus()
    event.send(suppressEmitter)
  })
}
