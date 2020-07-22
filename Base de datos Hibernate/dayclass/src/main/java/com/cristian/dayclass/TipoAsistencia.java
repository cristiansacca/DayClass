
package com.cristian.dayclass;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.persistence.Temporal;

@Entity
@Table(name="alumno", schema="dayclass")
public class TipoAsistencia implements Serializable{
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    private int id;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaAltaTipoAsistencia;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaBajaTipoAsistencia;
    private String nombreTipoAsistencia;

    public TipoAsistencia() {
    }

    public static long getSerialVersionUID() {
        return serialVersionUID;
    }

    public int getId() {
        return id;
    }

    public Date getFechaAltaTipoAsistencia() {
        return fechaAltaTipoAsistencia;
    }

    public Date getFechaBajaTipoAsistencia() {
        return fechaBajaTipoAsistencia;
    }

    public String getNombreTipoAsistencia() {
        return nombreTipoAsistencia;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setFechaAltaTipoAsistencia(Date fechaAltaTipoAsistencia) {
        this.fechaAltaTipoAsistencia = fechaAltaTipoAsistencia;
    }

    public void setFechaBajaTipoAsistencia(Date fechaBajaTipoAsistencia) {
        this.fechaBajaTipoAsistencia = fechaBajaTipoAsistencia;
    }

    public void setNombreTipoAsistencia(String nombreTipoAsistencia) {
        this.nombreTipoAsistencia = nombreTipoAsistencia;
    }
    
    
    
    
    
    
}
