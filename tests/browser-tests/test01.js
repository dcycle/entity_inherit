const { expect } = require('chai')
const fs = require('fs')

it('It should be possible to view the admin page', async function() {
  var screenshot = async function(page, name, content) {
    console.log('taking a screenshot ' + name)
    await page.screenshot({path: '/artifacts/screenshots/' + name + '.png'})
    console.log('saving state of the DOM (source code)')
    fs.writeFile('/artifacts/dom-captures/' + name + '.html', content, function(err) {
      if (err) {
        return console.log(err);
      }
      else {
        console.log('File ' + name + ' has been saved.');
        result = true
      }
      expect(result).to.be.true;
    });
  }
  this.timeout(25000);
  const puppeteer = require('puppeteer')
  const browser = await puppeteer.launch({
     headless: true,
     args: ['--no-sandbox', '--disable-setuid-sandbox']
  })
  var result = false
  try {
    const page = await browser.newPage()
    console.log('set viewport')
    await page.setViewport({ width: 1280, height: 800 })
    console.log('go to the login page')
    await page.goto('http://webserver/user')
    console.log('enter credentials')
    await page.type('[name=name]', process.env.DRUPALUSER)
    await page.type('[name=pass]', process.env.DRUPALPASS)
    await page.keyboard.press('Enter');
    await page.waitForSelector('#main-content')

    await screenshot(page, 'user', await page.content());

    console.log('go to /admin/config/entity_inherit')
    await page.goto('http://webserver/admin/config/entity_inherit')

    await page.waitForSelector('#edit-submit')
    await screenshot(page, 'admin-config-page', await page.content());
  }
  catch (error) {
    console.log('Exception alert')
    await browser.close()
    console.log(error);
  }
  await browser.close()
});
