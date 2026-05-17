// 地図オブジェクトを格納するための変数
let map;
// Google Mapsの各種サービス（主にPlaces APIなど）を利用するための変数
let service;
// マップ上に表示される情報ウィンドウ（吹き出し）のオブジェクト
let infowindow;

function initMap() {
  const location = { lat: 35.6812, lng: 139.7671 };

  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 15,
    center: location,
  });

  let marker = new google.maps.Marker({
    position: location,
    map: map,
  });

  const geocoder = new google.maps.Geocoder();

  document.getElementById("search-button").addEventListener("click", function () {
    const hospitalName = document.getElementById("hospital_name").value;

    geocoder.geocode({ address: hospitalName }, function (results, status) {
        if (status === "OK") {
            map.setCenter(results[0].geometry.location);

            marker.setPosition(results[0].geometry.location);
        } else {
            alert("場所が見つかりませんでした" + status);
        }
    });
  });
}

function editMap(visitId) {
  const geocoder = new google.maps.Geocoder();

  const map = new google.maps.Map(document.getElementById("map" + visitId), {
    zoom: 15,
  });
  
  let marker = new google.maps.Marker({
    map: map,
  });

  const hospitalInput = document.getElementById("hospital_name" + visitId);
  const searchButton = document.getElementById("search-button" + visitId);

  if (!hospitalInput || !searchButton) {
    return;
  }

  // 編集フォームを開いた時点で、登録済みの病院名から地図を表示
  const firstHospitalName = hospitalInput.value;

  if (firstHospitalName) {
    geocoder.geocode({ address: firstHospitalName }, function (results, status) {
      if (status === "OK") {
        map.setCenter(results[0].geometry.location);
        marker.setPosition(results[0].geometry.location);
      }
    });
  }

  // 「場所を表示」クリック時に、入力中の病院名へ地図を移動
  searchButton.addEventListener("click", function () {
    const hospitalName = hospitalInput.value;

    geocoder.geocode({ address: hospitalName }, function (results, status) {
        if (status === "OK") {
            map.setCenter(results[0].geometry.location);

            marker.setPosition(results[0].geometry.location);
        } else {
            alert("場所が見つかりませんでした" + status);
        }
    });
  });
}