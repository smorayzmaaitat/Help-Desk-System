import{T as f,e as p,w as n,o as g,a as o,u as e,Z as w,b as r,d as m,i as b,n as _,f as x}from"./app-Bshtgp-Q.js";import{_ as y}from"./GuestLayout-B6UJ5HXT.js";import{_ as i,a as l,b as d}from"./TextInput-DgeFZJr9.js";import{P as v}from"./PrimaryButton-DkVSvryS.js";import"./ApplicationLogo-C-oCVjLM.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const V={class:"bg-white px-4 py-8 shadow sm:rounded-lg sm:px-10"},k={class:"mt-4"},h={class:"mt-4"},C={class:"mt-4"},q={class:"mt-6 flex items-center justify-between"},A={__name:"Register",setup(B){const s=f({name:"",email:"",password:"",password_confirmation:""}),u=()=>{s.post(route("register"),{onFinish:()=>s.reset("password","password_confirmation")})};return(c,a)=>(g(),p(y,null,{default:n(()=>[o(e(w),{title:"Register - Help Desk Ticketing System"}),a[6]||(a[6]=r("div",{class:"sm:mx-auto sm:w-full sm:max-w-md"},[r("h2",{class:"text-center text-2xl font-bold tracking-tight text-gray-900 mb-8"}," Help Desk Ticketing System "),r("h3",{class:"mt-2 text-center text-xl text-gray-600 mb-8"}," Create Your Account ")],-1)),r("form",{onSubmit:x(u,["prevent"]),class:"space-y-6"},[r("div",V,[r("div",null,[o(i,{for:"name",value:"Name",class:"font-semibold"}),o(l,{id:"name",type:"text",class:"mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500",modelValue:e(s).name,"onUpdate:modelValue":a[0]||(a[0]=t=>e(s).name=t),required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.name},null,8,["message"])]),r("div",k,[o(i,{for:"email",value:"Email",class:"font-semibold"}),o(l,{id:"email",type:"email",class:"mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500",modelValue:e(s).email,"onUpdate:modelValue":a[1]||(a[1]=t=>e(s).email=t),required:"",autocomplete:"username"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.email},null,8,["message"])]),r("div",h,[o(i,{for:"password",value:"Password",class:"font-semibold"}),o(l,{id:"password",type:"password",class:"mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500",modelValue:e(s).password,"onUpdate:modelValue":a[2]||(a[2]=t=>e(s).password=t),required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.password},null,8,["message"])]),r("div",C,[o(i,{for:"password_confirmation",value:"Confirm Password",class:"font-semibold"}),o(l,{id:"password_confirmation",type:"password",class:"mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500",modelValue:e(s).password_confirmation,"onUpdate:modelValue":a[3]||(a[3]=t=>e(s).password_confirmation=t),required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.password_confirmation},null,8,["message"])]),r("div",q,[o(e(b),{href:c.route("login"),class:"text-sm text-indigo-600 hover:text-indigo-500 font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"},{default:n(()=>a[4]||(a[4]=[m(" Already have an account? Sign in ")])),_:1},8,["href"]),o(v,{class:_(["ml-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500",{"opacity-25":e(s).processing}]),disabled:e(s).processing},{default:n(()=>a[5]||(a[5]=[m(" Create Account ")])),_:1},8,["class","disabled"])])])],32)]),_:1}))}};export{A as default};
