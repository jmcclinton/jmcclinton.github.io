var menuBtn = document.getElementsByClassName('menu-btn')
var mobileMenu = document.getElementsByClassName('mobile-menu')
var clickedBtn = function() {
  mobileMenu[0].classList.toggle('active')
}

menuBtn[0].addEventListener('click', clickedBtn)

console.log(menuBtn[0])
/*---------------Testimonials -------------*/

import {
  html,
  render
} from 'https://unpkg.com/lit-html?module';

var postData = []
var postImages = []

var findImageById = function(id) {
  var Image = postImages.filter( (item) => item.id == id)

  return Image[0].image
}

axios.get('wp-json/wp/v2/testimonials')
  .then(function(response) {
    var postIds = []
    postData = response.data
    //loop over all posts get the id of each and push into array
    response.data.map((item) => postIds.push(item.id))

    function getImage0() {
      return axios.get('/wp-json/wp/v2/media?parent=' + postIds[0])
    }

    function getImage1() {
      return axios.get('/wp-json/wp/v2/media?parent=' + postIds[1])
    }

    function getImage2() {
      return axios.get('/wp-json/wp/v2/media?parent=' + postIds[2])
    }

    axios.all([getImage0(), getImage1(), getImage2()])
      .then(axios.spread(function(image0, image1, image2) {
        postImages.push({
          id: postIds[0],
          image: image0.data[0].media_details.sizes.medium_large.source_url
        })
        postImages.push({
          id: postIds[1],
          image: image1.data[0].media_details.sizes.medium_large.source_url
        })
        postImages.push({
          id: postIds[2],
          image: image2.data[0].media_details.sizes.medium_large.source_url
        })
        initApp(response)
        console.log(postImages)
      }))
      .catch(function(error) {
        //handle error
        console.log(error)
      })

  })
  .catch(function(error) {
    //handle error
    console.log(error)
  })

  var initApp = function(data) {
    let testimonialsData = data.data

    Array.prototype.swap = function(x, y) {
      var b = this[x]
      this[x] = this[y]
      this[y] = b
      return this
    }
    let clickedLeft = function() {
      postData.swap(1, 0)
      render(appTemplate(postData), document.getElementById('testimonials-app'))
    }
    let clickedRight = function() {
      postData.swap(1, 2)
      render(appTemplate(postData), document.getElementById('testimonials-app'))
    }
    function decodeEntities(encodedString) {
      var div = document.createElement('div');
      div.innerHTML = encodedString;
      return div.textContent;
    }
    const appTemplate = (data) => html `
    <div class="testimonials-container">
      <div class="test-sides test-left" @click=${(e) => clickedLeft()}>
        <div class="person-img" style="background: url('${findImageById(data[0].id)}');">
          <div class="hover-bg">
            <div class="name">${data[0].fname}</div>
          </div>
        </div>
      </div>
      <div class="test-center">
        <div class="header">
          <div class="user-img" style="background: url('${findImageById(data[1].id)}')">

          </div>
          <div class="info">
            <h4>${data[1].fname}</h4>
            <span>${data[1].usertitle}</span>
          </div>
        </div>
        <p>
          ${decodeEntities(data[1].content.rendered)}
        </p>
      </div>
      <div class="test-sides test-right" @click=${(e) => clickedRight()}>
        <div class="person-img" style="background: url('${findImageById(data[2].id)}')">
          <div class="hover-bg">
            <div class="name">${data[2].fname}</div>
          </div>
        </div>
      </div>
    </div>
    `

    render(appTemplate(postData), document.getElementById('testimonials-app'))
  }
