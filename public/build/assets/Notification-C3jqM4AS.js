import{A as f,b as h,c as y,d as g,e as B}from"./AuthenticatedLayout-PWHvvRgb.js";import{_ as b}from"./_plugin-vue_export-helper-DlAUqK2U.js";import{r as o,e as F,w as v,o as a,b as t,a as l,c as r,F as w,G as k,t as c,d as I}from"./app-Bshtgp-Q.js";import"./ApplicationLogo-C-oCVjLM.js";const N={components:{AuthenticatedLayout:f,BsBellFill:h,BsInboxFill:y,BsInfoCircleFill:g,BsPeopleFill:B},props:{notifications:{type:Array,default:()=>[]}},methods:{extractSender(n){return n.trim().split(" ")[1]},formatDate(n){return new Date(n).toLocaleDateString("en-US",{year:"numeric",month:"short",day:"numeric",hour:"2-digit",minute:"2-digit"})}}},S={class:"container mx-auto px-4 py-6"},A={class:"flex items-center mb-6"},C={key:0,class:"text-center py-10"},D={key:1,class:"space-y-4"},L={class:"flex justify-between items-center mb-2"},P={class:"flex items-center"},V={class:"text-lg font-semibold text-gray-800"},j={class:"text-sm text-gray-500"},E={class:"text-gray-600"},G={class:"mt-2 text-sm text-gray-500 flex items-center"};function T(n,e,i,U,q,d){const m=o("BsBellFill"),x=o("BsInboxFill"),_=o("BsInfoCircleFill"),u=o("BsPeopleFill"),p=o("AuthenticatedLayout");return a(),F(p,null,{default:v(()=>[t("div",S,[t("div",A,[l(m,{class:"mr-3 text-blue-600 text-3xl"}),e[0]||(e[0]=t("h1",{class:"text-2xl font-bold text-gray-800"},"Notifications",-1))]),i.notifications.length===0?(a(),r("div",C,[l(x,{class:"mx-auto text-6xl text-gray-300 mb-4"}),e[1]||(e[1]=t("p",{class:"text-gray-500"},"No notifications at the moment.",-1))])):(a(),r("div",D,[(a(!0),r(w,null,k(i.notifications,s=>(a(),r("div",{key:s.id,class:"bg-white shadow-md rounded-lg p-4 border-l-4 border-blue-500 hover:shadow-lg transition-shadow duration-300 group"},[t("div",L,[t("div",P,[l(_,{class:"mr-2 text-blue-500"}),t("h2",V,c(s.title),1)]),t("span",j,c(d.formatDate(s.created_at)),1)]),t("p",E,c(s.content),1),t("div",G,[l(u,{class:"mr-2 text-gray-400"}),I(" Sent by: "+c(d.extractSender(s.content)),1)])]))),128))]))])]),_:1})}const M=b(N,[["render",T]]);export{M as default};