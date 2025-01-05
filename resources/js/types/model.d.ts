import {
    AttributeInput,
    AttributeType,
    BannerField,
    Fuel,
    Gear,
    ItemState,
    PageCategory,
    PhotoState,
    StepType,
    UserState,
} from '@/types/enums';

export interface User {
    id: number;
    username: string | null;
    email: string;
    phone: string;
    password?: string;
    state: UserState;
    role_id: number | null;
    active_at: string | null;
    created_at: string;
    updated_at: string;

    profile?: Profile;
    phone_formatted?: string;
}

export interface Profile {
    id: number;
    user_id: number;
    name: string;
    surname: string;
    company: string | null;
    company_phone: string | null;
    address: string | null;
    tax_identity: string | null;
    province_id: number | null;
    district_id: number | null;
    created_at: string;
    updated_at: string;

    full_name: string;
    province?: Province;
    district?: District;
}

export interface Province {
    id: number;
    name: string;
    code: number;
    title: string;
    slug: string;
    created_at: string;
    updated_at: string;

    districts?: District[];
}

export interface District {
    id: number;
    name: string;
    province_id: number;
    title: string;
    slug: string;
    created_at: string;
    updated_at: string;

    province?: Province;
    neighborhoods?: Neighborhood[];
}

export interface Neighborhood {
    id: number;
    name: string;
    district_id: number;
    title: string;
    slug: string;
    created_at: string;
    updated_at: string;

    district?: District;
}

export interface Brand {
    id: number;
    active: boolean;
    name: string;
    title: string;
    slug: string;
    logo: string | null;
    order: number | null;
    created_at: string;
    updated_at: string;

    logo_src?: string | null;
    vehicles_count?: number;
}

export interface AttributeCategory {
    id: number;
    active: boolean;
    type: AttributeType;
    vehicle_type_id: number | null;
    name: string;
    order: number;
    description: string | null;
    created_at: string;
    updated_at: string;

    vehicle_type?: VehicleType;
    type_label?: string;
    attributes?: Attribute[];
    attributes_count?: number;
}

export interface Attribute {
    id: number;
    active: boolean;
    attribute_category_id: number;
    input: AttributeInput;
    name: string;
    description: string | null;
    unit: string | null;
    order: number | null;
    required: boolean;
    hidden: boolean;
    created_at: string;
    updated_at: string;

    category?: AttributeCategory;
    values?: AttributeValue[];
    input_label?: string;
}

export interface AttributeValue {
    id: number;
    attribute_id: number;
    value: string;
    created_at: string;
    updated_at: string;
}

export interface VehicleType {
    id: number;
    active: boolean;
    name: string;
    title: string;
    slug: string;
    logo: string | null;
    order: number | null;
    step_type: StepType;
    created_at: string;
    updated_at: string;

    logo_src?: string | null;
}

export interface Vehicle {
    id: number;
    active: boolean;
    vehicle_type_id: number;
    brand_id: number;
    title: string;
    slug: string;
    stock_code: string | null;
    year: number;
    series: string;
    model: string;
    submodel: string | null;
    gear: Gear;
    fuel: Fuel;
    engine_power: number;
    engine_size: number;
    created_at: string;
    updated_at: string;

    type?: VehicleType;
    brand?: Brand;
    attributes: VehicleAttribute[];
    gear_label: string;
    fuel_label: string;
}

export interface VehicleAttribute {
    id: number;
    vehicle_id: number;
    attribute_id: number;
    attribute_value_id: number | null;
    value: any;
    created_at: string;
    updated_at: string;

    attribute?: Attribute;
}

export interface Item {
    id: number;
    user_id: number;
    vehicle_id: number;
    state: ItemState;
    title: string;
    price: number;
    kilometer: number;
    description: string | null;
    province_id: number;
    district_id: number;
    neighborhood_id: number;
    note: string | null;
    created_at: string;
    updated_at: string;

    state_label?: string;
    vehicle?: Vehicle;
    province?: Province;
    district?: District;
    neighborhood?: Neighborhood;
    attributes?: ItemAttribute[];
    photos?: ItemPhoto[];
    approved_photos?: ItemPhoto[];
    cover?: ItemPhoto;
}

export interface ItemAttribute {
    id: number;
    item_id: number;
    attribute_id: number;
    attribute_value_id: number | null;
    value: any;
    created_at: string;
    updated_at: string;

    attribute?: Attribute;
}

export interface ItemPhoto {
    id: number;
    file: string;
    order: number;
    state: PhotoState;
    created_at: string;
    updated_at: string;

    src?: string;
}

export interface Page {
    id: number;
    active: boolean;
    category: PageCategory;
    title: string;
    slug: string;
    body: string | null;
    meta_title: string | null;
    meta_description: string | null;
    meta_keywords: string | null;
    created_at: string;
    updated_at: string;

    category_label?: string;
}

export interface Banner {
    id: number;
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

    field_label: string;
    image_src: string | null;
    mobile_image_src: string | null;
}
