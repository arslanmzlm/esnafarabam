import {
    AttributeInput,
    AttributeType,
    BannerField,
    Fuel,
    Gear,
    ItemState,
    PageCategory,
    StepType,
} from '@/types/enums';

export interface UserFormType {
    username: string | null;
    email: string;
    phone: string;
    password: string;
    password_confirmation: string;
    name: string;
    surname: string;
    company: string | null;
    company_phone: string | null;
    address: string | null;
    tax_identity: string | null;
    province_id: number;
    district_id: number;
}

export interface ProvinceFormType {
    name: string;
    code: number;
    title: string;
    slug: string | null;
}

export interface DistrictFormType {
    name: string;
    province_id: number;
    title: string;
    slug: string | null;
}

export interface NeighborhoodFormType {
    name: string;
    district_id: number;
    title: string;
    slug: string | null;
}

export interface BrandFormType {
    active: boolean;
    name: string;
    title: string;
    slug: string | null;
    logo: string | File | null;
    order: number | null;
}

export interface AttributeCategoryFormType {
    name: string;
    type: AttributeType;
    vehicle_type_id: number | null;
    description: string | null;
    order: number | null;
}

export interface AttributeFormType {
    active: boolean;
    attribute_category_id: number;
    input: AttributeInput;
    name: string;
    description: string | null;
    unit: string | null;
    values: {id: number | null; attribute_id?: number; value: string}[];
    order: number | null;
    required: boolean;
    hidden: boolean;
}

export interface VehicleTypeFormType {
    active: boolean;
    name: string;
    title: string;
    slug: string | null;
    logo: string | File | null;
    order: number | null;
    step_type: StepType;
}

export interface VehicleFormType {
    active: boolean;
    vehicle_type_id: number;
    brand_id: number;
    title: string;
    slug: string | null;
    stock_code: string | null;
    year: number;
    series: string;
    model: string;
    submodel: string | null;
    gear: Gear;
    fuel: Fuel;
    engine_power: number;
    engine_size: number;
    attributes?: {
        id: number | null;
        attribute_id: number;
        value: any;
    }[];
}

export interface ItemFormType {
    vehicle_id?: number;
    title: string;
    price: number;
    kilometer: number;
    description: string | null;
    province_id: number;
    district_id: number;
    neighborhood_id: number;
    attributes: {
        id: number | null;
        attribute_id: number;
        value: any;
    }[];
    photos: {
        id: number | null;
        file: any;
        order: number;
    }[];
}

export interface ItemControlFormType {
    approved_photos: number[];
    rejected_photos: number[];
    deleted_photos: number[];
    state: ItemState;
    note: string | null;
}

export interface PageFormType {
    active: boolean;
    category: PageCategory;
    title: string;
    slug: string | null;
    body: string | null;
    meta_title: string | null;
    meta_description: string | null;
    meta_keywords: string | null;
}

export interface BannerFormType {
    active: boolean;
    field: BannerField;
    title: string;
    alt_title: string | null;
    sub_title: string | null;
    body: string | null;
    excerpt: string | null;
    link_label: string | null;
    link: string | null;
    image: string | null;
    mobile_image: string | null;
    alt: string | null;
    options: object | null;
}
