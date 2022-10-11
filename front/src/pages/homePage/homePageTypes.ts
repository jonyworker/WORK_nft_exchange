export interface IPanel {
    id: number;
    name: string;
    photo_url: string;
    contract: string;
    item_qty: number;
    market_cap: string;
    market_cap_p: number;
    volume_24: string;
    volume_24_p: number;
    sales_24?: any;
    holders: number;
    website: string;
    twitter: string;
    discord: string;
    instagram: string;
    category: string;
    floor_price: string;
    introduction: string;
    member: string;
    roadmap: string;
    floor_price_p:number;
    health_score:any;
    holders_p:number;
    unit:string;
}

export interface ITrend {
    date: string;
    floor_price: string;
    avg_price?: any;
    volume: string;
}

export interface IPie {
   [key: number]: number;
}

export interface panelData {
    data: IPanel,
    price_3d: ITrend[],
    price_30d: ITrend[],
    price_3m: ITrend[],
    holder_stat: IPie
}