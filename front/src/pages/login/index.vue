<template>
  <section class="mt-80">
    <div class="container">

      <!-- NFT分析 標題組 -->
      <div class="row mb-40">
        <div class="col-12 d-flex justify-content-lg-center justify-content-start align-items-center">
          <div class="section-title-wrap flex-column align-items-lg-center align-items-start">
            <!-- 標題  -->
            <h2 class="section-title color-white mb-8">
              {{ $t('home.linkWallet') }}
            </h2>

            <p class="section-subTitle color-white mb-lg-24 mb-16">{{ $t('home.loginSub') }}</p>

          </div>
        </div>
      </div>


      <!-- 登入連結 -->
      <div class="row justify-content-center ">
        <div class="col-lg-6 col-md-10 col-12">
          <div class="login-link-group">
            <!-- <div v-for="(item,index) in walletList" :key="index" :class="['tags',type===item.id?'active_tags':'']" @click="chageTag(item.id)">
              <div class="image"><img :src="item.image" alt=""> </div>
              <div class="name">{{item.name}}</div>
            </div> -->
            <div class="login-link-wrap" @click="chageTag(1)">
              <div class="image">
                <img src="@/assets/images/metamask.png" alt="">
              </div>
              <p class="heading-B-2 ml-auto color-white text-end">MetaMask</p>
            </div>

            <div class="login-link-wrap" @click="chageTag(4)">
              <div class="image">
                <img src="@/assets/images/walletconnect.png" alt="">
              </div>
              <p class="heading-B-2 ml-auto color-white text-end">Wallet Connect</p>
            </div>
          </div>
        </div>
      </div>


    </div>
  </section>
</template>

<script lang="ts" setup>

import {homeApi} from "@/api";
import {onMounted, ref} from "vue";
import {useRouter} from 'vue-router';
import {useStore} from "vuex";

let web3: any;
let firstScan: boolean = true;
let account: any = null;
let connector: any = null;
const store = useStore();
const type = ref(0);
const router = useRouter();

// interface Window {
//   ethereum: string
//   WalletConnect: string
//   WalletConnectQRCodeModal: string
// }
// const window = ref<Window|null>(null);
const ethereum = (window as any).ethereum
const WalletConnect = (window as any).WalletConnect
const WalletConnectQRCodeModal = (window as any).WalletConnectQRCodeModal

const getImage = (url: any) => {
  return new URL(url, import.meta.url).href;
}
const walletList = ref([
  {id: 1, name: 'MetaMask', image: getImage("../../assets/images/metamask.png")},
  // {id:2,name:'imToken',image:getImage("../../assets/images/minting_1.png")},
  // {id:3,name:'SafePal',image:getImage("../../assets/images/minting_2.png")},
  {id: 4, name: 'Wallet Connect', image: getImage("../../assets/images/walletconnect.png")},
  // {id:5,name:'Coinbase Wallet',image:getImage("../../assets/images/minting_4.png")},
])
const chageTag = async (value: number) => {
  type.value = value
  switch (value) {
    case 1:
      metamask().connect()
      break;
    case 4:
      walletconnect().connect()
      break;
    default:
      break;
  }
}
const getWallet = async (acc: string) => {
  const params = {
    address: acc
  }
  const res = await homeApi.postLogin(params);
  console.log("-> res", res);
  if (res.status === "OK") {
    store.commit('changeLoginStatus', true)
    store.commit('updateToken', res.token)
    store.commit('user/updateLoginInfo', res)
    localStorage.setItem('username', res.username);
    localStorage.setItem('status', res.status);
    localStorage.setItem('token', res.token);
  }
}
const getJs = (jsUrl: string) => {
  let script = document.createElement('script');
  // script.type = 'text/javascript';
  script.src = jsUrl;
  document.body.appendChild(script);
}
const login = () => {
  router.push({name: 'Home',})
}
const bind = () => {
  connector = new WalletConnect.default({
    bridge: "https://bridge.walletconnect.org", // Required
    qrcodeModal: WalletConnectQRCodeModal.default,
  });
  // Subscribe to connection events
  connector.on("wc_sessionRequest", (error: any, payload: any) => {
    if (error) {
      throw error;
    }

    console.log("wc_sessionRequest", payload)
  });
  // Subscribe to connection events
  connector.on("wc_sessionUpdate", (error: any, payload: any) => {
    if (error) {
      throw error;
    }
    console.log("wc_sessionUpdate", payload)
  });
  // Subscribe to connection events
  connector.on("connect", (error: any, payload: any) => {
    if (error) {
      throw error;
    }

    // Get provided accounts and chainId
    const {accounts, chainId} = payload.params[0];
    console.log("connect", accounts)
    walletconnect().setAccount(connector._accounts[0]);
  });

  connector.on("session_update", (error: any, payload: any) => {
    if (error) {
      throw error;
    }

    // Get updated accounts and chainId
    const {accounts, chainId} = payload.params[0];
    console.log("accounts", accounts)
    walletconnect().setAccount(connector._accounts[0]);
  });

  connector.on("disconnect", (error: any, payload: any) => {
    if (error) {
      throw error;
    }
    console.log("登出")
    // Delete connector
  });
  console.log(connector)
}
const walletconnect = () => {
  const self = this
  const fn = {
    init: function () {
      // Subscribe to connection events
    },
    connect: function () {
      bind();
      if (!connector.connected) {
        // create new session
        connector.createSession();
      } else {
        metamask().login(account, 2);
      }
    },
    logout: function () {
      account = null;
      if (connector == null) return
      connector.killSession()
    },
    setAccount: function (acc: string) {
      account = acc;
      console.log("取得token登入", account)
      //alert(account);
      metamask().login(account, 2);
    }
  }
  return fn
}
const metamask = () => {
  const fn = {
    isInstall: function () {
      if (typeof ethereum !== 'undefined') { //check metamask
        console.log('MetaMask is installed!');
      } else {
        //此為進首頁提示,先關掉
        //alert("未安裝狐狸錢包 , 請檢查狐狸錢包")
      }
    },
    connect: function () {
      //ethereum.request({ method: 'eth_requestAccounts' });
      try {
        ethereum.request({
          method: 'eth_requestAccounts'
        }).then((result: any) => {
          account = result[0];
          console.log()
          console.log("帳號", account)
          metamask().login(account, 1);
        }).catch((error: any) => {
          //console.log("出問題",error)
          if (error.code == -32002) {
            alert("錢包連結中, 請點一下右上角小狐狸工具進行登入驗證")
          }
        });

        ethereum.on('accountsChanged', function (accounts: any) {
          account = accounts[0];
          metamask().login(account, 1);
        });
      } catch (e: any) {
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Pixel|Opera Mini/i.test(navigator.userAgent) && firstScan == false) {
          if (account != null) {
            metamask().login(account, 1);
          } else {
            alert("偵測為手機版,開啟Walletconnect")
            setTimeout(() => {
              // location.href="https://metamask.app.link/dapp/www.nftotal.io/"
              walletconnect().connect()
            }, 3000);
          }
        } else {
          if (firstScan == false) {
            alert("未安裝狐狸錢包 , 請檢查狐狸錢包")
          }
          firstScan = false
        }
      }
    },
    login: function (acc: string, type: any) {
      getWallet(acc)
    },
    logOut: function () {
      walletconnect().logout();
    }
  }
  return fn;
}

onMounted(() => {
  // getJs('https://cdn.jsdelivr.net/gh/ethereum/web3.js/dist/web3.min.js')
  // getJs('https://cdn.jsdelivr.net/npm/@walletconnect/client@1.7.7/dist/umd/index.min.js')
  // getJs('https://cdn.jsdelivr.net/npm/@walletconnect/qrcode-modal/dist/umd/index.min.js')

  // getWallet()
})
</script>

<style scoped lang="less">
// @media screen and (min-width: 768px){
//   .wrap-title{
//     font-size: 30px !important;
//     text-align: left !important;
//   }
//   .tags{
//     font-size: 30px !important;
//     display: flex;
//     justify-content: space-between;
//     .image{
//       padding-left: 20px;
//       img{
//         width:40px;
//         height:40px;
//         margin-top:-12px;
//       }
//     }
//   }
//   .wrap-subTitle{
//     font-size: 16px !important;
//     text-align: left !important;
//   }
// }
// @media screen and (max-width: 450px){
//   .wrap-title{
//     font-size: 28px !important;
//     text-align: left !important;
//   }
//   .tags{
//     font-size: 28px !important;
//     display: flex;
//     justify-content: space-between;
//     .image{
//       padding-left: 20px;
//       img{
//         width:30px;
//         height:30px;
//         margin-top:-12px;
//       }
//     }
//   }
//   .wrap-subTitle{
//     font-size: 14px !important;
//     text-align: left !important;
//   }
// }
// .wrap-title{
//   padding-top: 50px;
//   text-align: center !important;
//   padding-bottom: 10px;
//   //width: 1200px;
//   //margin: auto;
//   font-size: 32px;
// }
// .wrap-subTitle{
//   text-align: center;
//   font-size: 18px;
// }
// .wrap-tabs{
// //width: 636px;
//   margin:30px auto;
// }
// .tags{
//   background: #121212;
//   border: 2px solid rgba(255, 255, 255, 0.1);
//   border-radius: 20px;
//   height: 60px;
//   line-height:60px;
//   margin-bottom: 15px;
//   text-align: right;
//   padding-right: 40px;
//   font-size: 32px;
// }
// .tags:hover{
//   background: #414141;
//   border: 2px solid #4447E2;
//   border-radius: 20px;
// }
// .active_tags{
//   background: #414141;
//   border: 2px solid #4447E2;
//   border-radius: 20px;
// }


.login-link-group {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.login-link-wrap {
  width: 100%;
  display: flex;
  align-items: center;
  background: #1C1C24;
  border: 2px solid rgba(255, 255, 255, 0.1);
  border-radius: 16px;
  padding: 24px 40px;
}

.login-link-wrap:hover {
  border: 2px solid #4447E2;
  background: #414141;
}

.login-link-wrap .image {
  width: 56px;
}


</style>