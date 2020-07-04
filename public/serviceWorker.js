const staticDevCoffee = "d-cafe-site-v1"
const assets = [
  "/",
  "/assets",
  "/css/style.css"
]

self.addEventListener("install", installEvent => {
  installEvent.waitUntil(
    caches.open(staticDevCoffee).then(cache => {
      cache.addAll(assets)
    })
  )
})
