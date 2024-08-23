import { Company } from "./company";

export interface People {
    id: number;
    nombre_completo: string;
    fecha: string;
    correo: string;
    area: string;
    is_favorite: number;
    categoria: string;
    nivel_de_satisfaccion: number;
    created_at: string;
    updated_at: string;
    company_id: number;
    company: Company;
}
