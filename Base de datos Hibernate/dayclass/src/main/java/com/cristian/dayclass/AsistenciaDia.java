
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
@Table(name="AsistenciaDia", schema="dayclass")
public class AsistenciaDia implements Serializable {
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)
    private int id;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaHoraAsisDia;
    @ManyToOne
    private TipoAsistencia tipoAsistencia;
    
    @ManyToOne
    private Asistencia asistencia;
    
     public AsistenciaDia() {
    }
    
    public static long getSerialVersionUID() {
        return serialVersionUID;
    }

    public int getId() {
        return id;
    }

    public void setTipoAsistencia(TipoAsistencia tipoAsistencia) {
        this.tipoAsistencia = tipoAsistencia;
    }

    public void setAsistencia(Asistencia asistencia) {
        this.asistencia = asistencia;
    }

    public TipoAsistencia getTipoAsistencia() {
        return tipoAsistencia;
    }

    public Asistencia getAsistencia() {
        return asistencia;
    }

    public Date getFechaHoraAsisDia() {
        return fechaHoraAsisDia;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setFechaHoraAsisDia(Date fechaHoraAsisDia) {
        this.fechaHoraAsisDia = fechaHoraAsisDia;
    }

   
    
    
}
