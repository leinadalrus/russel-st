import './index'

function cover(description, testing) {
  description = {}
  testing = {}

  let coverage = description.forEach((key, val) => {
    testing[key] = val
  })

  JSON.stringify(coverage)
  console.log('Description:\n\t%v\nTesting:\n\t%v', description, testing)

  return 0
}

function run() {
  processFormData()
  console.log(processFormData())
}

function test() {
  cover('Test: covering----; FormData', run())
}

test()
