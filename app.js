const puppeteer = require(`puppeteer`)
const express = require(`express`)
const app = express()
const port = 80

app.get(`/`, async (req, res) => {
    if (!req.query.id) res.send(`What you see?`)
    else try {
        const browser = await puppeteer.launch({
  	    args: ['--no-sandbox', '--disable-setuid-sandbox'],
	})
        const [page] = await browser.pages()

	page.setDefaultNavigationTimeout(0)
        await page.setRequestInterception(true);
        page.on('request', (request) => {
            if (['image', 'stylesheet', 'font'].indexOf(request.resourceType()) !== -1) request.abort()
            else request.continue()
        });

        await page.goto(`https://www.midasbuy.com/midasbuy/id/buy/pubgmlite`)
        await type(page, `.game-wrap .tab-nav-box .box .input-box.have-select-input-box .input`, req.query.id)
        await click(page, `.game-wrap .tab-nav-box .box .btn`)
        await click(page, `.game-wrap .tab-nav-box .new-y-box .user-head .name, .pop-mode-box .pop-mode .new-y-box .user-head .name`)
        const result = await page.evaluate(() => {
            return document.querySelector(`.game-wrap .tab-nav-box .new-y-box .user-head .name, .pop-mode-box .pop-mode .new-y-box .user-head .name`).innerHTML
        })

        res.send(JSON.stringify({name: result}))
    } catch (e) {
        console.error(e)
        res.send(JSON.stringify(e))
    }
})

app.listen(port, () => {
    console.log(`Example app listening on port ${port}`)
})

const click = async function (page, selector) {
    await page.waitForSelector(selector)
    await page.hover(selector)
    await page.$eval(selector, (btn) => btn.click())
}

const type = async function (page, selector, letters) {
    await page.waitForSelector(selector);
    await page.hover(selector);
    await page.focus(selector);
    await page.keyboard.type(letters);
}
